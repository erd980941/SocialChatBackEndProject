using FluentValidation;
using FluentValidation.Results;
using Microsoft.AspNetCore.Http;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;

namespace Core.Extensions
{
    public class ExceptionMiddleware
    {
        private RequestDelegate _next;

        public ExceptionMiddleware(RequestDelegate next)
        {
            _next = next;
        }
        public async Task InvokeAsync(HttpContext httpContext)
        {
            try
            {
                await _next(httpContext);
            }
            catch (Exception ex)
            {

                await HandleExceptionAsync(httpContext, ex);
            }
        }

        private Task HandleExceptionAsync(HttpContext httpContext, Exception ex)
        {
            httpContext.Response.ContentType = "application/json";
            httpContext.Response.StatusCode = (int)HttpStatusCode.InternalServerError;
            
            string message = "Internal Server Error";
            IEnumerable<ValidationFailure> errors;
            if (ex.GetType()==typeof(ValidationException))
            {
                message = ex.Message;
                errors = ((ValidationException)ex).Errors;

                return httpContext.Response.WriteAsync(new ValidationErrorDetails
                {
                    Errors=errors,
                    Message=message,
                    StatusCode=400
                }.ToString());
            }
            return httpContext.Response.WriteAsync(new ErrorHandlerDetails
            {
                StatusCode = httpContext.Response.StatusCode,
                Message = ex.Message,
            }.ToString());
        }
    }
}
