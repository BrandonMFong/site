# Site

Site is to display my portfolio

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Software:
* [Visual Studio Code](https://code.visualstudio.com/) - Text editor 
* [Xampp](https://www.apachefriends.org/index.html) - To run the site on your localhost
* [Putty](https://www.putty.org/) - SSH access
* [WinSCP](https://winscp.net/eng/download.php) - FTP
* [PowerShell](https://docs.microsoft.com/en-us/powershell/scripting/install/installing-powershell?view=powershell-7) - To run scripts

### Installing

To run the site locally, you must have under /config/:

env.xml:
```
<?xml version="1.0" encoding="ISO-8859-1"?>
<Site 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
    xsi:schemaLocation="..\schema\Site.xsd">
    <IsUnderMaintenance>True</IsUnderMaintenance>
    <Environment>Local</Environment>
</Site>
```

environmentcredentials.xml:

```
<?xml version="1.0" encoding="ISO-8859-1"?>
<Site 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
    xsi:schemaLocation="..\schema\Site.xsd">
    <Variables>
        <Variable Environment="Local">
            <Servername></Servername>
            <Username></Username>
            <Password></Password>
            <Database></Database>
        </Variable>
        <Variable Environment="Server">
            <Servername></Servername>
            <Username></Username>
            <Password></Password>
            <Database></Database>
        </Variable>
    </Variables>
</Site>
```

After you have these required xml, you must run Open-Putty.ps1 in powershell.

## Deployment

Right now the site is running on Hostinger servers.  The deployment process is just using git to pull down code to the server.

There are two sites:
* [brandonmfong.com](http://www.brandonmfong.com/) - Main site
* [dev.brandonmfong.com](http://dev.brandonmfong.com/) - Development Site

## Authors

* **Brandon Fong** - *Initial work* - [GitHub](https://github.com/BrandonMFong)

