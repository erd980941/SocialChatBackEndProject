using Entities.Dtos;
using FluentValidation;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.UserRepository.Validation.FluentValidation
{
    public class UserChangePasswordValidator:AbstractValidator<UserChangePasswordDto>
    {
        public UserChangePasswordValidator()
        {
            RuleFor(p=>p.CurrentPassword).NotEmpty().WithMessage("Mevcut Şifre Boş Olamaz.");
            RuleFor(p => p.NewPassword).NotEmpty().WithMessage("Şifre Boş Olamaz.");
            RuleFor(p => p.NewPassword).MinimumLength(6).WithMessage("Şifre En Az 6 Karakter Olmalıdır.");
            RuleFor(p => p.NewPassword).Matches("[A-Z]").WithMessage("Şifre En Az 1 Büyük Harf İçermelidir.");
            RuleFor(p => p.NewPassword).Matches("[a-z]").WithMessage("Şifre En Az 1 Küçük Harf İçermelidir.");
            RuleFor(p => p.NewPassword).Matches("[0-9]").WithMessage("Şifre En Az 1 Adet Sayı İçermelidir.");
            RuleFor(p => p.NewPassword).Matches("[^a-zA-Z0-9]").WithMessage("Şifre En Az 1 Adet Özel Karakter İçermelidir.");
        }
    
    }
}
