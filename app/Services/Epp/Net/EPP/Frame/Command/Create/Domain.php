<?php

class Net_EPP_Frame_Command_Create_Domain extends Net_EPP_Frame_Command_Create
{
    public function __construct()
    {
        parent::__construct('domain');
    }
}
