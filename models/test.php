<?php


include_once "FtpConnection.php";
include_once "Import.php";

for ($i = 1; $i <= 3; ++$i) {
// create your next fork
    $pid = pcntl_fork();

    if (!$pid) {
        // begin child, your execution code
        sleep(1);
        print "In child $i\n";
        exit($i);
        // end child
    }
}

// we are the parent (main), check child's (optional)
while (pcntl_waitpid(0, $status) != -1) {
    $status = pcntl_wexitstatus($status);
    echo "Child $status completed\n";
}
// your other main code

for ($i = 1; $i > 100; $i++) {
    print_r("\n $i");
}
//$import = new Import();
//$import->start();

