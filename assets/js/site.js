const t=document.querySelector('.menu-toggle');if(t)t.addEventListener('click',()=>{const n=document.querySelector('.nav');const open=n.classList.toggle('open');t.setAttribute('aria-expanded',String(open));});

// Use Japan's time zone as a client-side fallback when the hosting provider
// does not expose a visitor country. The locale cookie lets PHP format prices
// and render the correct document language on the following request.
(() => {
  const hasLocale = document.cookie.split('; ').some((item) => item.startsWith('site_locale='));
  if (!hasLocale) {
    let locale = document.documentElement.lang === 'ja' ? 'ja' : 'en';
    try { if (locale !== 'ja' && Intl.DateTimeFormat().resolvedOptions().timeZone === 'Asia/Tokyo') locale = 'ja'; } catch (_) {}
    document.cookie = `site_locale=${locale}; path=/; max-age=31536000; SameSite=Lax`;
    if (locale === 'ja') { location.reload(); return; }
  }
  if (document.documentElement.lang !== 'ja') return;

  const translations = new Map(Object.entries({
    'THOUGHTFUL TECH. BETTER VALUE.':'いいテクノロジーを、もっとお得に。',
    'Find your next iPhone.':'次の iPhone を見つけよう。',
    'Compare new and refurbished iPhones, with clear prices and options for every budget.':'新品と整備済み iPhone を、わかりやすい価格と幅広い選択肢から比較できます。',
    'Shop current deals':'セールを見る','Explore refurbished':'整備済みを見る',
    'Good phones. Better deals.':'いい iPhone を、もっとお得に。',
    'Save on new and refurbished iPhone models.':'新品・整備済み iPhone をお得に。',
    'SHOP THE COLLECTION':'商品一覧','Popular iPhones':'人気の iPhone','View all deals →':'すべてのセールを見る →',
    'Clear pricing':'明瞭な価格','See the price and savings before you add a phone to your bag.':'バッグに追加する前に、価格と割引額をご確認いただけます。',
    'New and refurbished':'新品と整備済み','Explore options across recent and previous iPhone models.':'最新モデルから旧モデルまでお選びいただけます。',
    'Compare models':'モデルを比較','Choose the storage and model that fits your needs.':'用途に合ったモデルと容量をお選びください。',
    'Need help?':'お困りですか？','Contact our team':'お問い合わせ','with your questions.':'ご質問はこちらからどうぞ。',
    'Home':'ホーム','New iPhones':'新品 iPhone','Refurbished':'整備済み','Deals':'セール','About':'当店について','Contact':'お問い合わせ','Bag':'バッグ',
    'NEW IPHONES':'新品 iPhone','REFURBISHED':'整備済み','New':'新品','Refurbished':'整備済み',
    'From':'価格：','· Demo inventory':'・掲載商品はデモ用です','Add to bag':'バッグに追加','Add to bag ·':'バッグに追加 ·','Save':'割引',
    'CURRENT OFFERS':'開催中のセール','Good phones. Better deals.':'いい iPhone を、もっとお得に。',
    'Your bag':'ショッピングバッグ','Your bag is ready for something good.':'バッグに商品を追加しましょう。','Browse iPhone deals':'セール商品を見る',
    'Qty':'数量','Remove':'削除','Update bag':'バッグを更新','Order summary':'注文概要','Subtotal':'小計','Discount':'割引','Shipping':'送料',
    'Calculated at checkout':'チェックアウト時に計算','Estimated tax':'消費税（概算）','Current total':'合計','Continue to checkout':'チェックアウトへ',
    'SECURE CHECKOUT':'安全なチェックアウト','Shipping details':'配送先情報','Country':'国','United States':'日本',
    'First name':'名','Last name':'姓','Email':'メールアドレス','Phone':'電話番号','Street address':'住所','Apartment / suite':'建物名・部屋番号','City':'市区町村','ZIP code':'郵便番号','State':'都道府県','Select state':'都道府県を選択',
    'Add to bag':'バッグに追加','Product details':'商品詳細','Storage':'ストレージ','Color':'カラー','Condition':'状態',
    'Shop':'ショッピング','Customer care':'カスタマーサポート','Policies':'各種ポリシー','New iPhones':'新品 iPhone','Returns':'返品','Warranty':'保証','Privacy':'プライバシー','Terms':'利用規約','Cookies':'Cookie ポリシー'
  }));
  const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
  let node;
  while ((node = walker.nextNode())) {
    const original = node.nodeValue.trim();
    if (translations.has(original)) node.nodeValue = node.nodeValue.replace(original, translations.get(original));
  }
})();
