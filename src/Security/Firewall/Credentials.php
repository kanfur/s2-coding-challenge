<?php declare(strict_types=1);

namespace App\Security\Firewall;

use App\Security\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

final class Credentials
{
    private string $email;
    private string $password;
    private string $token;

    private function __construct(string $email, string $password, string $token)
    {
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function token(): string
    {
        return $this->token;
    }

    public static function fromRequest(Request $request): Credentials
    {
        return new self(
            email: (string) $request->request->get('email'),
            password: (string) $request->request->get('password'),
            token: (string) $request->request->get('_csrf_token')
        );
    }
}
