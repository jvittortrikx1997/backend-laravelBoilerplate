<?php

namespace App\Domain\Services;

use App\Domain\Repositories\UserCodeRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\UseCases\SendTwoFactorCode;
use DomainException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthLoginService
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
        protected readonly UserCodeRepositoryInterface $userCodeRepository,
        protected readonly SendTwoFactorCode $sendTwoFactorCode
    )
    {
    }

    public function login(array $credentials): JsonResponse
    {
        $attempt = $this->buildAttemptArray($credentials);

        $token = Auth::attempt($attempt);

        if (!$token) {
            throw new DomainException('Usuário ou senha inválidos', 401);
        }

        $user = JWTAuth::user();

        if ($user->USUEXCLUIDO) {
            throw new DomainException('Não autorizado', 401);
        }

        $token = JWTAuth::claims($user->getAttributes())->fromUser($user);

        if (!$token) {
            throw new DomainException('Erro ao gerar token', 401);
        }

        if ($credentials['verify_code'] === null) {
            $code = $this->generateVerificationCode();
            $this->userCodeRepository->updateOrCreateCode($user->USUUID, $code);
            $this->sendTwoFactorCode->execute($user->USUNOME, $user->USUEMAIL, $code);

            return response()->json([
                'message' => 'Código de verificação enviado para o email',
                'data' => [],
            ]);
        }

        $this->userCodeRepository->getUserCode($user->USUUID, $credentials['verify_code']);
        $this->userCodeRepository->deleteUserCode($user->USUUID, $credentials['verify_code']);

        return response()->json([
            'message' => 'Usuário loga com sucesso!',
            'data' => [
                'access_token' => $token,
            ],
        ]);
    }

    protected function buildAttemptArray(array $credentials): array
    {
        return isset($credentials['cpf'])
            ? ['USUCPF' => $credentials['cpf'], 'password' => $credentials['password']]
            : ['USUEMAIL' => $credentials['email'], 'password' => $credentials['password']];
    }

    protected function generateVerificationCode(): int
    {
        return rand(100000, 999999);
    }

}
