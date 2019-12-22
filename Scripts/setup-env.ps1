# This copies the git repo to xampp to run the php scripts
# Assumptions:
#   - Path to scripts is B:\SITES\BrandonFongMusic\Scripts
#   - Name of Git Repo is \BrandonFongMusic
#   - There is an alias Chrome -> C:\Program Files (x86)\Google\Chrome\Application\chrome.exe
#   - xampp exists on machine 
#   - running in powershell
#   - scripts is in the base folder of your repo (should be)

############################## I M P O R T A N T ############################################
# PLEASE EDIT THESE VAIRABLES IF THEY DON'T MATCH YOUR MACHINE
try 
{
    set-alias Chrome 'C:\Program Files (x86)\Google\Chrome\Application\chrome.exe' 
}
catch 
{
    Write-Warning "Alias already exist or you haven't download them";
    Write-Warning $_;
}
        
# VARIABLES
$replace = 'B:\\SITES\\'; 
$xampp_dir = 'C:\xampp\htdocs\';
$xampp = 'C:\xampp\';
$base_dir = 'B:\SITES\';
$repo_name = 'BrandonFongMusic';
$git_repo_dir = $base_dir.ToString() + $repo_name.ToString() + '\';
$scripts_dir = $git_repo_dir + 'Scripts';
$logfile = $git_repo_dir + "logs\debug.log";
$local_flag = $git_repo_dir + "logs\.is_local";
if (!(Test-Path $logfile)){New-Item $logfile;} # Creates a log file, might not use
if (!(Test-Path $local_flag)){New-Item $local_flag;} # Creates a local flag to tell php we are running locally.  IE never run this on the server. This script is only for local testing

############################## I M P O R T A N T ############################################

Push-Location $scripts_dir; 
    if(!(Test-Path $xampp))
    {
        Write-Warning "Xampp is not downloaded on this machine or it is located somewhere different.";
        Write-Host "Making directory but need the program to run local website.";
        mkdir $xampp;
        mkdir $xampp_dir;
        Write-Host "Successfully made " $xampp_dir " & " $xampp;
    }
    # Removes files
    if(Test-Path $xampp_dir*)
    {
        Write-Host "There are files here, going to clear out directory...";
        try 
        {
            Remove-Item $xampp_dir* -Force -Confirm; # Just say "Yes to All"
        }
        catch 
        {
            Write-Warning "Something bad happened";
            Write-Error $_;
            Write-Warning "Exiting program...";   
            exit;
        }
        Write-Host "Deletion successful";
    }

    # Copies files
    Push-Location $base_dir;
        # This is just miscelleneous.  Don't need this
        if (Test-Path $git_repo_dir){ Get-ChildItem | Where-Object{$_.Name -eq $repo_name;}| ForEach-Object{$path = $_.FullName};}

        # This command showed me that I needed this script
        #Copy-Item .\BrandonFongMusic\* $dir; 

        # Gets all the directory names in the repo
        $directory = [System.Collections.ArrayList]::new(); 
        $base_directory = [System.Collections.ArrayList]::new(); 
        
        # recurse through the repo
        # filters only directory type
        # adds directory path to an arraylist
        Get-ChildItem $git_repo_dir -r | Where-Object{$_.Attributes -eq "Directory"}|ForEach-Object{$directory.Add($_.fullName)};
        
        # This get's the trailing directoory name of the file path
        # Using this to compare for the copy function
        Get-ChildItem $git_repo_dir -r | Where-Object{$_.Attributes -eq "Directory"} | ForEach-Object{$base_directory.Add($_.BaseName)}
        $directory.Add($git_repo_dir);
        $base_directory.Add($repo_name);
        
        Write-Host "Obtained all directories in git repo " $git_repo_dir;

        Write-Host "Stripping file paths...";
        
        $new_directory = [System.Collections.ArrayList]::new(); 
        for($j = 0; $j -lt $directory.Count; $j++)
        {
            $new_directory.Add($directory[$j] -replace $replace); # takes all items in the array list, replaces b:\site with nothing and adds it into new array list
            Write-Host $directory[$j] " --> " $new_directory[$j]; 
        }

        Write-Host "Appending " $xampp_dir " and making directory";
        
        $destination = [System.Collections.ArrayList]::new(); 
        for($j = 0; $j -lt $new_directory.Count; $j++)
        {
            $destination.Add($xampp_dir.ToString() + $new_directory[$j].ToString());
            Write-Host $new_directory[$j] " --> " $destination[$j];
            try # in the case if the directory already exists
            {
                if(!(Test-Path $destination[$j])){mkdir $destination[$j]; Write-Host "Made directory.";}
                else{Write-Host "Directory already exists.";}
            }
            catch
            {
                Write-Host "Something went wrong";
                Write-Error $_;
                Write-Host "Exiting program...";
                exit;
            }
        }
        Write-Host "Appending and making directory successful";

        Write-Host "`nLooking for Files";

        $files = [System.Collections.ArrayList]::new();
        $files_base_dir = [System.Collections.ArrayList]::new();

        # Gets files full path
        Get-ChildItem $git_repo_dir -r |Where-Object{$_.Attributes -eq "Archive"}|ForEach-Object{$files.Add($_.FullName)};
        
        # Gets the trailing component of the file path to the directories
        # Going to use this to compare
        Get-ChildItem $git_repo_dir -r | Where-Object{$_.Attributes -eq "Archive"} | ForEach-Object{ $_.Directory}|ForEach-Object{$files_base_dir.Add($_.BaseName)}
        
        Write-Host "Found " $files.Count " files in " $git_repo_dir;

        Write-Host "Start copies...";
        for($k = 0; $k -lt $files.Count; $k++)
        {
            for($d = 0; $d -lt $directory.Count; $d++)
            {
                if($files_base_dir[$k] -eq $base_directory[$d])# error here because .vscode contains .vs
                {
                    # for($m = 0; $m -lt $directory.Count; $m++)
                    # {
                    #     # trying to get the max length of the directory 
                    #     # safe to say that is the true directory the want
                    #     # kind of like a sorting algorithm here
                    #     if(($files[$k].Contains($directory[$m])) -and ($directory[$m] -gt $directory[$d]))
                    #     {
                    #         $d = $m;
                    #     }
                    # }
                    Copy-Item $files[$k] $destination[$d];
                    Write-Host "Copied" $files[$k] " to " $destination[$d]; # stuck in a loop here
                    
                }
                Write-Progress -Activity 'Copying Files' -Status 'Progress:' -PercentComplete $d; 
            }
        }

        Write-Progress -Activity 'Success.  Finishing final steps.';
        Write-Host "`nSuccessfully copied files`n";
        
        Write-Host "Copied Items from " $path " to " $xampp_dir;
        Write-Host "`nOpening browser @ localhost in 3 seconds...";
        Start-Sleep -s 3;
        try 
        {
            chrome "localhost";
        }
        catch
        {
            Write-Host "Something went wrong.";
            Write-Host "Alias probably doesn't exist";
            Write-Error $_;
            Write-Host "Exiting program.";
            exit;
        }
    Pop-Location;
Pop-Location;
