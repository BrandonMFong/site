$PSScriptRoot| Split-Path -Parent | Split-Path -Leaf | ForEach-Object{ $repo_name = $_};# the directory you are debugging
    
    $PSScriptRoot| Split-Path -Parent | Split-Path -Parent | ForEach-Object{ $base_dir = $_ + '\'}; # file path before the public_html directory
    $replace = $base_dir -replace '\\', '\\'; # file path before the public_html directory
    
    $xampp_dir = 'C:\xampp\htdocs\'; # where xampp is to debug php scripts
    $xampp = 'C:\xampp\'; # xampp folder
     
    $PSScriptRoot| Split-Path -Parent | ForEach-Object{ $git_repo_dir = $_ + '\'};
    $git_repo_dir = $base_dir.ToString() + $repo_name.ToString() + '\'; # entire path to public_html
    $git_repo_dir;
    $test;

    $PSScriptRoot;