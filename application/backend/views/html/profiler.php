<?php
/**
 * Must include profiler is child one level of DOM body
 * <profiler></body>
 */
?>
<style type="text/css">
    #show-profiler, #codeigniter_profiler { display: none; }
    #show-profiler:checked~#codeigniter_profiler { display:block; }
</style>
<input type=checkbox id="show-profiler">
<label for="show-profiler">Show/Hide Profiler</label>