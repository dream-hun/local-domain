<?php

class Net_EPP_Frame_Command_Update extends Net_EPP_Frame_Command
{
    public function __construct($type)
    {
        $this->type = $type;
        parent::__construct('update', $type);
    }
}
