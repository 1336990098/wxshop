<?php
    return [
        //应用ID,您的APPID。
        'app_id' => "2016092600601804",

        //商户私钥，您的原始格式RSA私钥
        'merchant_private_key' => "MIIEpQIBAAKCAQEAu+oQftPnyq9jmtHSVT+mGt11n42V/sYATREx3lzj/bCfLdvjqj0g2QV5FKIl6XLdoRPkH+exd2VLWU5Jl+aO3m1vZxbejFVcqvm7RWEI2QhhZD3bwTgZ1BNMn3X3fYeQbWT6iUOyi6ZQy1YAMCyyvRevee4ax+wDe2f/Oef2jmTdlXE2TqxkQekNxVG5w6+HclMHizmX5kWheNZl0T+Nv5SxrQH9rQZNEC1lTEhVKo+SaV9YUTdJrWz82C6MlW3kGwUCBKMhHND3nFcGcD3fe3Q+XvsfcS2uuBGoOktk1VggCcN0y/d+QvrL7jSxfUQyTTuEOBvjv1fxzWVrgRfGfQIDAQABAoIBAAyt4GsOVUeByhC6M5z47HZHlxYq8YH9TivlCx5b2i5V6oennJbyBPNfwSm5PyGfVID33J6ifYD23ryp4aFUNzOe4rNsAZwqblRDAXXO9E/gluGyos9Iv8Vlf/gKd6aKrR4UgCse3D87+5ucs+qMOYs0u+xYOopezGVZQQlhM2usGQV2YLt8K6ZqM4ZiELkd1ZpUwgdxjlgFmODsIdMxIN86JxemqVfj/iCwZT8gJABe2asrxPF20x/5uq6GRFBF2jb0cLeNYGLgGnCW7xUJGqs+EnZxXogSwccWmHOWiqudYnsP2rvZx02ZWU5guON5CGI1QwKiVJKn/gFAb+2e3CkCgYEA3nKQ5BCtjcaATF6UCiQtqhyxiUyqipLGju7LIirif/6jT74Mo67mLoX6cOPbcJLyn+kVCijdFvAFr3K8zNtgwf1O2zH2h5I/DTn5V79KkJXCrveTKc5tkWFE9RyFm3+o11j62UwriAGENIk3lZLwGAr+6xJ8wcGKZJbj9WJG/ksCgYEA2EIOn7XHxj0ChWQaBKgLBx+J2ipvr8vqd+/Cn7zi5avtMiAuYDaNElfNak3yNjDc27C4hpbTCxhcYWmOwytHdeW/5YVTGgw4dCDAlN98Ls4H1jv/HjFSl0TyeN2vqBhucGD9EdknIiyVkbyi1uV4Wfv51fChYOvS1uVQpdIBMVcCgYEAhJXYknb2WuiTk/FTX3AM37XWg7V0eL/fJVZjMOxKsGt/v4nRUsZuYBBvI1ZMdx6/Cl0Ms0+D56YMXXSP37JqS3XFyJRREqEyf5msaoaT1PXOYiciSerGF77YMRhc8j/2zNQ2P8pMr/XnbMDUpow8GriDFG2ieoH3ENl26c03710CgYEA1vv8S7tLqYA3RGI6F0zzAZbR1QeA1lOyeJ7qbSA6tDXRbJZfZBh277hHphls44B53xB0sJ+5l/sUw2ZLnSwmM0c+GK8M6QUjDhcNPDJb4q/BTLGCMgK4Z1cMcSl5GXOIPsG8c4TcCXYnDqVngJjIpzP+rzczRwXJKQb4wI/fzasCgYEA3XadWQh8BGiADWn2Rz/a40+nd6TW95rfhtM3uam7oHDaKxNd0P4LfifJImIyq8Sg8YXmQWB7zHyeZ6qu5SqbHhiE0hSVXccxGuT8478tGIwMXTXWVItRvkXeJOz+Hfw1H+NinNamST/c/+VFpqTyFyLpXPEq0I+UWxB2vcry2PA=",
        //异步通知地址
        'notify_url' => "http://wxshop.com/alipay/notify",

        //同步跳转
        'return_url' => "http://wxshop.com/alipay/return",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxLKPbAa6ryFPF4NWJWR7j0d+HGd3RA3JwdP6O2UYt/sYk/VHTMaozHr/ynUWewHBFRfF12vs8PNzodhGaEIF5F28/laFtZeox0mG9p7U9QCIgTDhumBGqrHN+zbkKh1EQ3bTS+yQ4sVr9T92FbmyYBPb3M7JwXXXCU+BXAGqM10gLjHk/bYMyH+UwXiojBFpF3ZjTNHcRjrlpr7u/toIhE4nb9r+sBa3NGj2XHXcwwaHJnvsqGfpsX3YzZzDzbT8H6yxD/VCQlSn0VKXVT3b61Yx3aoocIXw6/wvdwxtNOKK+Uni8cZHTNGm4Tu9/jolFQuV91rYLrgiQAoMrO8O0QIDAQAB",

        //标识沙箱环境
        "mode"=>'dev'
    ];