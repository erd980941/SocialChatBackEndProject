using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.UserOperationClaimRepository.Constans
{
    public class UserOperationClaimMessages
    {
        public static string Added = "Yetki Ataması Başarıyla Oluşturuldu";
        public static string Updated = "Yetki Ataması Başarıyla Güncellendi";
        public static string Deleted = "Yetki Ataması Başarıyla Silindi";
        public static string OperationClaimSetExist = "Bu kullanıcıya Bu Yetki Daha Önce Atanmış";
        public static string OperationClaimNotExist = "Seçtiğiniz Yetki Bulunamadı";
        public static string UserNotExist = "Seçtiğiniz Kullanıcı Bulunamadı";
    }
}
