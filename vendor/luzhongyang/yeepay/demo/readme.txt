
            ╭───────────────────────╮
    ────┤           易宝支付代码示例结构说明           ├────
            ╰───────────────────────╯ 
       1、该工程为web工程，可以直接部署到本地服务器执行！
       2、示例访问地址：http://mobiletest.yeepay.com/demo/
    ─────────────────────────────────
───────
 代码文件结构
───────
JAVA—UTF-8
    │
    ├yeepay ┈┈┈┈┈┈┈┈┈┈类文件夹
    │  │
    │  ├config.php┈┈┈┈┈基础配置类文件
    │  │
    │  ├yeepayMPay.php┈┈┈┈┈┈易宝支付（一键支付）接口函数类、基础地址文件
    │  │ 
    │  ├toMobilepayDemo.php┈┈┈┈┈移动端网页支付参数处理类文件
    │  │ 
    │  ├toPCpayDemo.php┈┈┈┈┈PC网页支付参数处理类文件
    │  │   
    │  ├Crypt_AES.php┈┈┈┈┈AES加密算法工具类
    │  │  
    │  └Crypt_RSA.php┈┈┈┈┈RSA加密算法工具类
    │
    └readme.txt ┈┈┈┈┈┈┈┈┈使用说明文本

●商户的私钥、商户的公钥、支付宝公钥

1、根据秘钥对生成链接http://mobiletest.yeepay.com/file/caculate/to_rsa生成对应的商户私钥和商户公钥
2、把生成的商户公钥复制到商户后台（www.yeepay.com）进行报备生成对应的易宝公钥
3、把对应的商户编号、秘钥对在payapi.properties基础配置类文件对应修改其参数值。
注：不要存在空格

