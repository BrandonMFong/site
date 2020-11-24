
# Apache
[string]$apacheJobName = "apache_start.xampp";
[string]$o = (Get-Job).Name | findstr.exe $apacheJobName;
if(![string]::IsNullOrEmpty($o))
{
    Stop-Job -Name $apacheJobName -Verbose;
    Remove-Job -Name $apacheJobName -Verbose;
}

# MySQL
[string]$mysqlJobName = "mysql_start.xampp";
[string]$o = (Get-Job).Name | findstr.exe $mysqlJobName;
if(![string]::IsNullOrEmpty($o))
{
    Stop-Job -Name $mysqlJobName -Verbose;
    Remove-Job -Name $mysqlJobName -Verbose;
}