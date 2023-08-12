using Entities.Concrete;
using Entities.Dtos;
using FluentValidation;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Authentication.Validation.FluentValidation
{
    public class AuthValidator : AbstractValidator<RegisterAuthDto>
    {
        public AuthValidator()
        {
            RuleFor(p => p.Name).NotEmpty().WithMessage("Kullanıcı Adı Boş Olamaz.");
            RuleFor(p => p.Email).NotEmpty().WithMessage("Email Adresi Boş Olamaz.");
            RuleFor(p => p.Email).EmailAddress().WithMessage("Geçerli Bir Email Adresi Girin.");
            RuleFor(p => p.Image.FileName).NotEmpty().WithMessage("Resim Boş Olamaz.");
            RuleFor(p => p.Password).NotEmpty().WithMessage("Şifre Boş Olamaz.");
            RuleFor(p => p.Password).MinimumLength(6).WithMessage("Şifre En Az 6 Karakter Olmalıdır.");
            RuleFor(p => p.Password).Matches("[A-Z]").WithMessage("Şifre En Az 1 Büyük Harf İçermelidir.");
            RuleFor(p => p.Password).Matches("[a-z]").WithMessage("Şifre En Az 1 Küçük Harf İçermelidir.");
            RuleFor(p => p.Password).Matches("[0-9]").WithMessage("Şifre En Az 1 Adet Sayı İçermelidir.");
            RuleFor(p => p.Password).Matches("[^a-zA-Z0-9]").WithMessage("Şifre En Az 1 Adet Özel Karakter İçermelidir.");
        }
    }
}
