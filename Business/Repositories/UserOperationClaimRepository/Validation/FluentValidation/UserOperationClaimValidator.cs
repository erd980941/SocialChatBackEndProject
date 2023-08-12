using Entities.Concrete;
using FluentValidation;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.UserOperationClaimRepository.Validation.FluentValidation
{
    public class UserOperationClaimValidator:AbstractValidator<UserOperationClaim>
    {
        public UserOperationClaimValidator()
        {
            RuleFor(p => p.UserId).Must(IsIdValid).WithMessage("Yetki Ataması İçin Kullanıcı Seçimi Yapmalısınız.");        
            RuleFor(p => p.OperationClaimId).Must(IsIdValid).WithMessage("Yetki Ataması İçin Yetki Seçimi Yapmalısınız.");        
        }
        private bool IsIdValid(int id)
        {
            if (id>0 && id!=null)
            {
                return true;
            }
            return false;
        }
    }
}
