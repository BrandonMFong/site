# This copies the git repo to xampp to run the php scripts
# Assumptions:
#   - Path to scripts is B:\SITES\BrandonFongMusic\Scripts
#   - Name of Git Repo is \BrandonFongMusic
#   - There is an alias Chrome -> C:\Program Files (x86)\Google\Chrome\Application\chrome.exe
#   - xampp exists on machine

# Uncomment if the alias doesn't exist
# set-alias Chrome 'C:\Program Files (x86)\Google\Chrome\Application\chrome.exe' 
        
$replace = 'B:\\SITES';
$xampp_dir = 'C:\xampp\htdocs';
$site_dir = 'B:\SITES\';
$repo_name = 'BrandonFongMusic';
$git_repo_dir = $site_dir.ToString() + $repo_name.ToString() + '\';
$logfile = $dir.ToString() + "\debug.log";
New-Item $logfile;

Push-Location 'B:\SITES\BrandonFongMusic\Scripts'; 

    # Removes files
    if(Test-Path $xampp_dir*)
    {
        Write-Host "There are files here, going to clear out directory...";
        try 
        {
            Remove-Item $xampp_dir* -Force -Confirm;
        }
        catch 
        {
            Write-Host "Something bad happened";
            Write-Host $_;
            Write-Host "Exitting program...";   
            break;
        }
        Write-Host "Deletion successful";
    }

    # Copies files
    Set-Location $site_dir;
    if (Test-Path $git_repo_dir)
    {
        Get-ChildItem | 
            Where-Object
            {
                $_.Name -eq $repo_name;
            }| 
                ForEach-Object{$path = $_.FullName};
    }

    #Copy-Item .\BrandonFongMusic\* $dir; 

    # Gets all the directory names in the repo
    $directory = [System.Collections.ArrayList]::new(); 
    Get-ChildItem $git_repo_dir -r | # recurse through the repo
        Where-Object{$_.Attributes -eq "Directory"}| # filters only directory type
            ForEach-Object{$directory.Add($_.fullName)}; # adds directory path to an arraylist

    $new_directory = [System.Collections.ArrayList]::new(); 
    for($j = 0; $j -lt $directory.Count; $j++)
    {
        $new_directory.Add($directory[$j] -replace $replace); # takes all items in the array list, replaces b:\site with nothing and adds it into new array list
    }

    $temp = [System.Collections.ArrayList]::new(); 
    for($j = 0; $j -lt $new_directory.Count; $j++)
    {
        $temp.Add($dir.ToString() + $new_directory[$j].ToString());
        mkdir $temp[$j];
    }

    $files = [System.Collections.ArrayList]::new();
    Get-ChildItem $git_repo_dir -r |
        Where-Object{$_.Attributes -eq "Archive"}|
            ForEach-Object{$files.Add($_.FullName)};

    for($k = 0; $k -lt $files.Count; $k++)
    {
        for($d = 0; $d -lt $directory.Count; $d++)
        {
            if($files[$k].Contains($directory[$d]))
            {
                Move-Item $files[$k] $temp[$d];
                Write-Host "Moved" $files[$k] " to " $temp[$d];
                
            }
            Write-Progress -Activity 'Copying Files' -Status 'Progress:' -PercentComplete $d 
        }
    }
    Write-Host "Successfully copied files";
    
    Write-Host "Copied Items from " $path " to " $xampp_dir;
    Write-Host "Opening browser @ localhost in 3 seconds...";
    Start-Sleep -s 3;
    chrome "localhost";
Pop-Location
