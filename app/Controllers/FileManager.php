<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ResticCredModel;

class FileManager extends BaseController
{
    public function index()
    {
        // Load your view here to display the file manager interface
        return view('file_manager_view');
    }

    public function listFiles()
    {
        // Define the directory path you want to list files from
        $directory = ROOTPATH . $_ENV['RESTIC_BACKBLAZE_DIR'];

        $resticCredModel = new ResticCredModel();

        $b2AccountDetails = $resticCredModel->where('b2_account_id', '003bf1355f7d3590000')->first();

        // All actual commands
        $cmds = [
            'export B2_ACCOUNT_ID=' . $b2AccountDetails['b2_account_id'],
            'export B2_ACCOUNT_KEY=' . $b2AccountDetails['b2_account_key'],
            'export RESTIC_PASSWORD_FILE="' . $b2AccountDetails['b2_account_key'] . '"',
            'export RESTIC_REPOSITORY="b2:erp-backups:/backups"',

            'restic mount ' . $directory,
            'fusermount -u ' . $directory . 'to unmount'



            // mount from normal restic 
            // export RESTIC_PASSWORD_FILE="/root/restic-pw.txt"
            // export restic_repository="sftp:resticuser@mnabr1.com:/mnt/restic/erpdata-repo"
            // restic mount /path/to/view
            // fusermount -u /path/to/view to unmount
        ];

        $command = 'cp -r ' . ROOTPATH . 'Filemanager/* ' . $directory;
    
        $output = shell_exec($command);

        // Check if the directory exists
        if (is_dir($directory)) {
            $files = scandir($directory);
            $files = array_diff($files, ['.', '..']); // Remove . and .. entries

            // Return the list of files and directories as JSON
            return json_encode($files);
        } else {
            // Handle the case where the directory does not exist
            return json_encode(['error' => 'Directory not found']);
        }
    }

    public function downloadFile($filename)
    {
        // Define the directory path where the file is located
        $directory = ROOTPATH . $_ENV['RESTIC_BACKBLAZE_DIR'];

        // Check if the file exists in the directory
        if (file_exists($directory . '/' . $filename)) {
            // Set the appropriate headers for file download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            // Read and output the file
            readfile($directory . '/' . $filename);
        } else {
            // Handle the case where the file does not exist
            return 'File not found';
        }
    }
}
