# Site

My website is hosted on my Raspberry Pi within my LAN and is now open to the world for the whole internet to access.

[https://www.brandonmfong.com](http://www.brandonmfong.com/)

## Prerequisites

Software:
* [Visual Studio Code](https://code.visualstudio.com/) - Development 
* [Xampp](https://www.apachefriends.org/index.html) - Apache Server
* [WinSCP](https://winscp.net/eng/download.php) - FTP
* [PowerShell](https://docs.microsoft.com/en-us/powershell/scripting/install/installing-powershell?view=powershell-7) - Deploy/Tests

Must have creds.xml to run:

```
<?xml version="1.0" encoding="ISO-8859-1"?>
<Creds xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="..\schema\Creds.xsd">
    <Local>
        <Servername></Servername>
        <Username></Username>
        <Password></Password>
        <Database></Database>
    </Local>
    <Server>
        <Servername></Servername>
        <Username></Username>
        <Password></Password>
        <Database></Database>
    </Server>
</Creds>
```

## Authors

**Brandon Fong** - [GitHub](https://github.com/BrandonMFong)

