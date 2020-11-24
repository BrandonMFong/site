
# Apache
Start-Job -ScriptBlock {& "C:\xampp\apache_start.bat"} -Name "apache_start.xampp";

# MySQL
Start-Job -ScriptBlock {& "C:\xampp\mysql_start.bat"} -Name "mysql_start.xampp";