<div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?> forum">
<?php if (!$page) { ?>
	<h2 class="title"><a href="<?php print $node_url?>"><?php print $title?></a></h2>
<?php }; ?>
<?php if ($picture) {
	print $picture;
}?>
<span class="submitted"><?php print $submitted?></span>

<div class="taxonomy"><?php print $terms?></div>

<div class="content">
<?php 
if ($page){
//if (false){
	print $content;
	//var_dump($node->content);
} else {
	print $node->content['body']['#value'];
	if ($node->content['files']['#value']){print $node->content['files']['#value'];}

} ?>
</div>
<?php if ($node->relatedlinks && $page) { ?>
	<div class="related-links">
	<h3>Enllaços relacionats</h3>
	<ul>
	<?php
	foreach ($node->relatedlinks as $relatedlinks){
      		foreach ($relatedlinks as $link){
			printf('<li><a href="%s">%s</a></li>', $link[url], $link[title]);
		}
	} ?>
	</ul>
    	</div>
<?php } ?>
<?php if ($links) { ?>
	<div class="links"><?php print $links?></div>
<?php } ?>
</div>
