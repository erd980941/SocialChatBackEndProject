using Entities.Concrete;
using FluentValidation;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.UserRepository.Validation.FluentValidation
{
    public class UserValidator:AbstractValidator<User>
    {
        public UserValidator()
        {
            RuleFor(p => p.Name).NotEmpty().WithMessage("Kullanıcı Adı Boş Olamaz.");
            RuleFor(p => p.Email).NotEmpty().WithMessage("Email Adresi Boş Olamaz.");
            RuleFor(p => p.Email).EmailAddress().WithMessage("Geçerli Bir Email Adresi Girin.");
            RuleFor(p => p.ImageUrl).NotEmpty().WithMessage("Resim Boş Olamaz.");
        }
    }
}
