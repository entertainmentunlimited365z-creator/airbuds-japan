<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
function e(mixed $v): string { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function site_locale(): string {
    if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'ja'], true)) {
        setcookie('site_locale', $_GET['lang'], ['expires' => time() + 31536000, 'path' => '/', 'samesite' => 'Lax']);
        $_COOKIE['site_locale'] = $_GET['lang'];
    }
    if (isset($_COOKIE['site_locale']) && in_array($_COOKIE['site_locale'], ['en', 'ja'], true)) return $_COOKIE['site_locale'];
    $country = strtoupper((string)($_SERVER['HTTP_CF_IPCOUNTRY'] ?? $_SERVER['GEOIP_COUNTRY_CODE'] ?? ''));
    if ($country === 'JP' || preg_match('/^ja(?:-|,|;)/i', (string)($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? ''))) return 'ja';
    return 'en';
}
function is_japan(): bool { return site_locale() === 'ja'; }
function money(float $v): string {
    if (is_japan()) {
        $rate = (float)(getenv('JPY_PER_USD') ?: 150);
        return '¥' . number_format(round($v * max(1, $rate)), 0);
    }
    return '$' . number_format($v, 2);
}
function csrf(): string { if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(32)); return $_SESSION['_csrf']; }
function check_csrf(): void { if (!hash_equals(csrf(), (string)($_POST['_csrf'] ?? ''))) { http_response_code(419); exit('Session expired. Please go back and try again.'); } }
function products(): array {
 $names=['iPhone 17 Pro Max','iPhone 17 Pro','iPhone 17','iPhone Air','iPhone 16 Pro Max','iPhone 16 Pro','iPhone 16 Plus','iPhone 16','iPhone 15 Pro Max','iPhone 15 Pro','iPhone 15 Plus','iPhone 15','iPhone 14 Pro Max','iPhone 14 Pro','iPhone 14 Plus','iPhone 14','iPhone 13 Pro Max','iPhone 13 Pro','iPhone 13','iPhone 13 mini','iPhone 12 Pro Max','iPhone 12 Pro','iPhone 12','iPhone 12 mini','iPhone 11 Pro Max','iPhone 11 Pro','iPhone 11','iPhone SE'];
 // Explicit filename mapping avoids relying on inconsistent capitalization, spaces, or duplicate copies.
 $imageFiles=[
  'iPhone 17 Pro Max'=>'iphone-17-pro-max.webp',
  'iPhone 17 Pro'=>'iPhone 17 Pro.webp',
  'iPhone 17'=>'iPhone 17.webp',
  'iPhone Air'=>'iPhone Air.webp',
  'iPhone 16 Pro Max'=>'iPhone 16 Pro Max .webp',
  'iPhone 16 Pro'=>'iPhone 16 Pro.webp',
  'iPhone 16 Plus'=>'iPhone 16 Plus .webp',
  'iPhone 16'=>'iPhone 16 .webp',
  'iPhone 15 Pro Max'=>'iPhone 15 Pro Max .webp',
  'iPhone 15 Pro'=>'iPhone 15 Pro .webp',
  'iPhone 15 Plus'=>'iPhone 15 Plus .webp',
  'iPhone 15'=>'iPhone 15 .webp',
  'iPhone 14 Pro Max'=>'iPhone 14 Pro Max .webp',
  'iPhone 14 Pro'=>'iPhone 14 Pro.webp',
  'iPhone 14 Plus'=>'iPhone 14 Plus .webp',
  'iPhone 14'=>'iPhone-14 .webp',
  'iPhone 13 Pro Max'=>'iPhone 13 Pro Max .webp',
  'iPhone 13 Pro'=>'iPhone 13 Pro.webp',
  'iPhone 13'=>'iPhone 13 .webp',
  'iPhone 12 Pro Max'=>'iPhone 12 Pro Max .webp',
  'iPhone 12 Pro'=>'iPhone 12 Pro.webp',
  'iPhone 12'=>'iPhone 12.webp',
  'iPhone 12 mini'=>'iPhone 12 mini.webp',
  'iPhone 11 Pro Max'=>'iPhone 11 Pro Max .webp',
  'iPhone 11 Pro'=>'iPhone 11 Pro.webp',
  'iPhone 11'=>'iPhone 11.webp',
  'iPhone SE'=>'iPhone SE 3rd Gen 2022 .webp',
 ];
 $prices=[1199,1099,799,999,1099,999,899,799,999,899,799,699,899,799,699,599,799,699,599,499,699,599,499,399,599,499,399,299]; $out=[];
 foreach($names as $i=>$name){$new=$i<8;$slug=strtolower(str_replace(' ','-', $name)).($new?'-new':'-refurbished'); $orig=(float)$prices[$i]; $discount=$new?10:30;$imageFile=$imageFiles[$name]??null;$imagePath=$imageFile&&is_file(__DIR__.'/../assets/images/products/'.$imageFile)?'/assets/images/products/'.implode('/',array_map('rawurlencode',explode('/',$imageFile))):null;
 $out[$slug]=['id'=>$slug,'slug'=>$slug,'name'=>$name,'category'=>$new?'new':'refurbished','condition'=>$new?'New':'Refurbished','storage'=>$i>=27?['64GB','128GB']:($i>=24?['64GB','256GB']:['128GB','256GB','512GB']), 'colors'=>['Black','White','Blue'],'original'=>$orig,'discount'=>$discount,'price'=>round($orig*(1-$discount/100),2),'stock'=>8,'description'=>("Explore the " . $name . " in " . ($new ? "new" : "refurbished") . " condition. The product image is matched to this model where available. Verify unit condition, configuration, stock, and included accessories before purchase."),'image'=>$imagePath]; }
 return $out;
}
function product(string $id): ?array { $p=products(); return $p[$id]??null; }
function cart_count(): int { return array_sum(array_map('intval', $_SESSION['cart']??[])); }
function cart_data(): array { $items=[]; foreach($_SESSION['cart']??[] as $key=>$qty){[$id,$storage,$color]=array_pad(explode('|',$key),3,'');$p=product($id);if($p){$items[]=['key'=>$key,'p'=>$p,'qty'=>max(1,min(10,(int)$qty)),'storage'=>$storage,'color'=>$color];}} return $items; }
function cart_total(): float { $sum=0;foreach(cart_data() as $i)$sum += $i['p']['price']*$i['qty'];return round($sum,2); }
function url(string $path=''): string { return APP_URL . '/' . ltrim($path,'/'); }
function page_meta(string $title, string $description='Shop new and refurbished iPhones at iPhone Deals.'): array { return ['title'=>$title,'description'=>$description]; }
