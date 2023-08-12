using Entities.Concrete;
using FluentValidation;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.MessageRepository.Validation.FluentValidation
{
    public class MessageValidator:AbstractValidator<Message>
    {
        public MessageValidator()
        {
            RuleFor(p=>p.Timestamp).NotEmpty().WithMessage("Tarih Bilgisi Boş Olamaz");
            RuleFor(p=>p.SenderId).NotEmpty().WithMessage("Gönderen Bilgisi Boş Olamaz");
            RuleFor(p=>p.ReceiverId).NotEmpty().WithMessage("Alıcı Bilgisi Boş Olamaz");
            RuleFor(p=>p.MessageText).NotEmpty().WithMessage("Message İçeriği Boş Olamaz");
        }
    }
}
