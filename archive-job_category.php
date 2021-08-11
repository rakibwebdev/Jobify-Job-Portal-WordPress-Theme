<?php
// get the currently queried taxonomy term, for use later in the template file
$term = get_queried_object();
echo $term->name;
echo "from archive-job-cat";
?>