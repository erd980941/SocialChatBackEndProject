﻿using Core.Extensions;
using Entities.Concrete;
using Microsoft.Extensions.Configuration;
using Microsoft.IdentityModel.Tokens;
using System;
using System.Collections.Generic;
using System.IdentityModel.Tokens.Jwt;
using System.Linq;
using System.Security.Claims;
using System.Security.Cryptography;
using System.Text;
using System.Threading.Tasks;

namespace Core.Utilities.Security.JWT
{
    public class TokenHandler : ITokenHandler
    {
        IConfiguration _configuration;

        public TokenHandler(IConfiguration configuration)
        {
            _configuration = configuration;
        }

        public Token CreateToken(User user, List<OperationClaim> operationClaims)
        {
            Token token = new Token();

            //Security Key Simetriği
            SymmetricSecurityKey securityKey = new SymmetricSecurityKey(Encoding.UTF8.GetBytes(_configuration["Token:SecurityKey"]));
            //Şifrelenmiş Kimlik
            SigningCredentials signingCredentials=new SigningCredentials(securityKey,SecurityAlgorithms.HmacSha256Signature);

            //Token ayarları
            token.Expiration=DateTime.Now.AddMinutes(60);
            JwtSecurityToken securityToken= new JwtSecurityToken(
                issuer: _configuration["Token:Issuer"],
                audience: _configuration["Token:Audience"],
                expires:token.Expiration,
                claims:SetClaims(user,operationClaims),
                notBefore:DateTime.Now,
                signingCredentials:signingCredentials
                );

            //Token oluşturucu sınıfından bir örnek
            JwtSecurityTokenHandler jwtSecurityTokenHandler = new JwtSecurityTokenHandler();

            //Token üretme
            token.AccessToken=jwtSecurityTokenHandler.WriteToken(securityToken);

            //RefreshTokenÜretme
            token.RefreshToken = CreateRefreshToken();

            return token;
        }

        public string CreateRefreshToken()
        {
            byte[] number=new byte[32];
            using (RandomNumberGenerator random= RandomNumberGenerator.Create())
            {
                random.GetBytes(number);
                return Convert.ToBase64String(number);
            }
        }

        private IEnumerable<Claim> SetClaims(User user,List<OperationClaim> operationClaims)
        {
            var claims= new List<Claim>();
            claims.AddName(user.Name);
            claims.AddRoles(operationClaims.Select(p => p.Name).ToArray());
            return claims;

        }
    }
}
