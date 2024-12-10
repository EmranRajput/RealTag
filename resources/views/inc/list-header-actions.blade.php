<?php
if (($urlAdd ?? '')) { ?>
<ul class="header-dropdown">
    <li class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false"><i class="zmdi zmdi-more-vert"></i></a>
        <ul class="dropdown-menu pull-right">
            <?php if($urlAdd ?? ''){ ?>
            <li><a href="{!! $urlAdd !!}">Add New</a></li>
            <?php } ?>
        </ul>
    </li>
</ul>
<?php } ?>