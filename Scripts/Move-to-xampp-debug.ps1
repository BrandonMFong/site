Push-Location 'B:\SITES\BrandonFongMusic\Scripts';
    $dir = 'C:\xampp\htdocs';
    if(Test-Path $dir\BrandonFongMusic){Remove-Item .\BrandonFongMusic -Force -Confirm;}
    Set-Location ..\..;
    Copy-Item .\BrandonFongMusic $dir;
Pop-Location
