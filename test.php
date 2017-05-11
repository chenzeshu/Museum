<?php
$str = "<p>请输入内容...<img src=\"http://mu.com/storage/temp/jQ89pMfPKpHKe8WgAeIXTvtTHtMuiExebPjxG080.png\" alt=\"大法2\"><img src=\"http://mu.com/storage/temp/2qkA8HRxtYgHioPUdXm6z9P6yNtK8l7jSQkU5BFt.png\" alt=\"大法2\"><img src=\"http://mu.com/storage/temp/fK1i7pwtIeoqtYivNCK0qQA03LVFlwZtwZRSUSHa.png\" alt=\"大法2\"></p>\r\n ◀
                        <p><br></p>";


preg_match_all('/<img.*?src="http:\/\/mu.com\/(.*?)".*?>/is',$str,$array);

print_r($array);