<?php
// 32バイトのランダムなバイナリデータを生成し、base64エンコードします。
$key = base64_encode(random_bytes(32));
echo $key;
