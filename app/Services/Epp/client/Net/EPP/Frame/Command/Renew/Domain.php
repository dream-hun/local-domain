<?php

class Net_EPP_Frame_Command_Renew_Domain extends Net_EPP_Frame_Command_Renew
{
    public function __construct()
    {
        parent::__construct('domain');
    }
}
