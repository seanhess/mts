<?php
    class ServerInformation 
    {
        public $UsersFile;
        public $WikiFrameFile;
        public $WrapperExt = ".php";
        public $BackupDirectory;
        public $SourceDirectory;
        public $CoreSourceFile;
        public $BaseInstallOffset;
        public $TemplatesDirectory;
        public $ModulesDirectory;

        public function __construct($baseInstallOffset="../../") {
            $this->BaseInstallOffset  = $baseInstallOffset;
            $this->calculate();
        }
        
        public function calculate() {
            $this->BackupDirectory = $this->BaseInstallOffset."MTS/Backups/";
            $this->SourceDirectory = $this->BaseInstallOffset."MTS/Source/";
            $this->UsersFile = $this->SourceDirectory."users.php";
            $this->WikiFrameFile = $this->SourceDirectory."wikiframe.php";
        
            $this->TemplatesDirectory = $this->BaseInstallOffset."MTS/Templates/";
            $this->CoreSourceFile = $this->TemplatesDirectory."core.html";
            $this->ModulesDirectory = $this->BaseInstallOffset."MTS/Modules/";
        }
    }
?>