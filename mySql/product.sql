-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-07 15:24:00
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mfee17_4_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(5) UNSIGNED NOT NULL,
  `brand` int(5) UNSIGNED NOT NULL,
  `intro` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creat_time` datetime DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `brand`, `intro`, `price`, `creat_time`, `status`) VALUES
(1, '【MIZUNO 美津濃】女款路跑背心 J2TA1201XX（任選）(T恤)', 1, 1, '吸汗快乾材質,​前胸後中反光燙印,優惠便宜好價格,值得推薦！', '476', '2021-07-04 11:00:44', 1),
(2, '【Molybeka 魔力貝卡】高強度運動-抗震QQ纖維X型美背運動內衣 / 運動背心(超值3件組-隨機)', 1, 2, '多次實驗調整\r\n完美比例QQ彈力纖維\r\n全面包覆胸部\r\n體驗自由運動的舒適\r\n滿足各種運動姿勢的溫柔包覆\r\n高強度防震支\r\n運動內衣也要滿滿的安全感\r\n\r\n商品內容：\r\n顏色：黑/膚/藍 隨機（不含內褲）\r\n\r\n材質：尼龍/氨綸\r\n\r\n適穿尺寸：\r\nS 70/32 BCD\r\nM 75/34 BCD\r\nL 80/36 BCD\r\nXL 85/38 BCD\r\n\r\n\r\n(((貼身內著衣物-內褲、襪子(基於衛生原則)，以上述無法受理退換貨，瑕疵品除外)))\r\n\r\n注意事項：\r\n布料染料時，深色比淺色不易固色，因此深色衣服下水時，會見水中有許色水，此屬正常現象，請您別擔心，請安心穿著！\r\n洗滌方法：手洗（深色衣物與淺色衣物請分開洗，請勿浸泡或使用洗衣機、脫水機，及任何刷子類物品清洗，請使用中性洗劑（沐浴乳、洗 精等），加入少許清水，待充分溶解后再放入衣物清洗。', '857', '2021-07-04 11:04:49', 1),
(3, 'S.G ADIDAS ORIGINALS ADICOLOR 短袖 女款 休閒 運動 透氣 純棉 天空藍', 1, 3, '', '870', '2021-07-04 11:04:49', 1),
(4, 'adidas 愛迪達】Yoga 輕量波紋瑜珈墊-8mm', 3, 3, '質地柔軟易捲便攜\r\n雙面紋理全面防滑\r\n立體支撐，提供專業防護作用\r\n環保材質無毒無味，親膚不刺激\r\n高密度緩衝減震，有效減小壓力\r\n\r\n【內容物】 瑜珈墊8mm\r\n【尺寸】 176 （L） ｘ 61 （W） ｘ 0.8 （H） cm\r\n\r\n【顏色/料號】 寶石紅／曬圖藍／草原綠\r\n寶石紅→ADYG-10100MR\r\n曬圖藍→ADYG-10100BL\r\n\r\n\r\n【重量】 0.5 Kg\r\n【產地】 中國大陸\r\n【材質】 EVA(85%)、TPE(15%)', '870', '2021-07-04 11:08:14', 1),
(5, '【adidas官方旗艦館】Alphabounce 跑鞋 運動鞋 男/女 共三款\r\n', 2, 3, 'A款 ALPHABOUNCE EK 跑鞋\r\n\r\n力求方便活動的實用跑鞋\r\n\r\n這款跑鞋旨在伴你在交叉訓練中發揮創意。\r\n\r\n採用彈力鞋面，挺括舒適，配橡膠大底，旨在方便活動。\r\n\r\n含Bounce中底，旨在為運動添舒適。\r\n\r\nB款 ALPHABOUNCE+ 跑鞋\r\n\r\n旨在為跑者打造的跑鞋\r\n\r\n提升競爭力。\r\n\r\n這款跑鞋按運動員跑步和訓練的方式設計，含成型結構，助你訓練側向移動。\r\n\r\n含Bounce+和襪套式結構，與你一同準備開練。\r\n\r\nC款 ALPHABOUNCE 1 跑鞋\r\n\r\n專為嚴苛訓練設計的支撐性跑鞋\r\n\r\n把每次練跑和敏捷度訓練當成比賽日。\r\n\r\n當比賽終於來臨，你已完全做好準備。\r\n\r\n這款 adidas 跑鞋專為全方位爆發加速力設計，助你跑出更強優勢。\r\n\r\n透氣鞋面具備彈性和穩定性，而彈力 Bounce 中底讓每個步伐都充滿力量。', '1120', '2021-07-04 11:08:14', 1),
(6, '【PUMA】女性 緊身褲 訓練褲 健身褲(多色選)', 1, 4, '此版型偏大 建議下訂小一碼\r\n約 S 腰圍33CM 臀圍42CM 褲長92CM\r\nM 腰圍36CM 臀圍45CM 褲長93CM\r\nL 腰圍39CM 臀圍49CM 褲長94CM\r\nXL腰圍42CM 臀圍53CM 褲長95CM\r\n商品產地︰ (依實際出貨為主)\r\n標示尺寸規格可能有正常誤差值1-3cm。商品圖檔顏色因攝影打光及個別電腦螢幕設定而略\r\n有不同，請以實際商品顏色為準。', '1599', '2021-07-04 11:11:31', 1),
(7, '【NIKE 耐吉】上衣 女款 短袖上衣 運動 訓練 慢跑 AS W NP 365 TOP SS ESSENTIAL 黑 AO9952-010\r\n', 1, 5, '', '616', '2021-07-04 11:14:27', 1),
(8, '【NIKE 耐吉】上衣 男款 短袖上衣 緊身 快乾 健身 運動 AS M NP TOP SS TIGHT 黑 BV5632-010\r\n', 1, 5, '', '572', '2021-07-04 11:14:27', 1),
(9, '【adidas官方旗艦館】ADICOLOR 運動短褲 男(GN3523)', 1, 3, 'ADIcolor 運動短褲 \r\n\r\n風格經典的必備款短褲\r\n\r\n無論是在池畔休息還是做做白日夢，這款 adidas 短褲都是不二之選。\r\n\r\n方便的口袋可攜帶錢包和手機，只要下水前記得拿出來就好。\r\n\r\n此單品採用高機能再生材質 Primegreen 製成。', '1237', '2021-07-04 11:14:27', 1),
(10, '【adidas官方旗艦館】D.O.N. Issue #2 短袖上衣 男(GP2235)', 1, 3, 'D.O.N. Issue #2 短袖上衣\r\n\r\nDonovan Mitchell就是一往無前，一心只想籃筐。\r\n\r\n無論是打球還是做別的，這款上衣旨在展現你對Donovan Mitchell的熱愛和他的精氣神。\r\n\r\n胸前反光網格式圖案，旨在致敬其綽號“Spida”所蘊含的氣質。\r\n\r\n此為亞洲尺寸。', '599', '2021-07-04 11:14:27', 1),
(11, '【PUMA官方旗艦】訓練系列麻花短袖T恤 男性 51455102\r\n', 1, 4, '\r\n', '616', '2021-07-04 11:19:31', 1),
(12, '【PUMA官方旗艦】瑜珈系列Studio扭結短版短袖T恤 女性 52022801', 1, 4, 'Burnout燒花印花，不對稱條紋設計，呈現透膚半透明效果\r\n網布拼接於領口及袖口，增添層次感\r\n前扭結設計，女生們無法抗拒的流行細節', '1080', '2021-07-04 11:19:31', 1),
(13, '【PUMA官方旗艦】Hybrid NX 慢跑運動鞋 男性 19225902\r\n', 2, 4, '', '2090', '2021-07-04 11:19:31', 1),
(14, '【NIKE 耐吉】MC TRAINER 男慢跑鞋-健身 訓練 運動 丈青黑白(CU3580400)\r\n', 2, 5, '', '1760', '2021-07-04 11:19:31', 1),
(15, '【adidas官方旗艦館】ULTRABOOST 21 跑鞋 運動鞋 男(FY0377)\r\n', 2, 3, 'ULTRABOOST 21 跑鞋\r\n\r\n提供極致能量回饋的 Ultraboost 21\r\n\r\n完美的定義不斷進化，第一雙 adidas Ultraboost 推出時是我們最高階的跑鞋。\r\n\r\n我們透過每一次的改良設計提高標準，造就前所未有的避震效能，以及空前的能量回饋。\r\n\r\n此版本搭配增量 6% 的 Boost 材質，以及具支撐力的 adidas Primeknit+ 鞋面。\r\n\r\nLinear Energy Push 系統為前足和中足提供支撐，讓每個步伐都充滿能量。', '4383', '2021-07-04 11:19:31', 1),
(16, '【MIZUNO 美津濃】WAVE PROPHECY X ㄧ般型男款慢跑鞋 J1GC210019(慢跑鞋)\r\n', 2, 1, '', '5504', '2021-07-04 11:19:31', 1),
(17, '【adidas 愛迪達】慢跑鞋 Ultraboost 20 襪套式 女鞋 愛迪達 三線 緩震 運動休閒 CNY 新年 黑紅(H04408)\r\n', 2, 3, '', '4080', '2021-07-04 11:19:31', 1),
(18, '【PUMA官方旗艦】Prowl Slip On 訓練運動鞋 女性 19307803\r\n', 2, 4, '', '1490', '2021-07-04 11:19:31', 1),
(19, '【NIKE 耐吉】慢跑鞋 Joyride Run 襪套 運動 女鞋 襪套 輕量 透氣 舒適 避震 路跑 健身 白 彩(CW2642-181)\r\n', 2, 5, '', '2980', '2021-07-04 11:19:31', 1),
(20, '【MIZUNO 美津濃】WAVE RIDER 24 一般型女款慢跑鞋 ENERZY中底材質 J1GD200301(慢跑鞋)\r\n', 2, 5, '', '2208', '2021-07-04 11:19:31', 1),
(21, '【adidas 愛迪達】ULTRABOOST 20 女 慢跑鞋 多款任選(FX7816 FX7811 EG0770 EG0716)\r\n', 2, 3, '', '3303', '2021-07-04 11:28:00', 1),
(22, '【adidas 愛迪達】Adidas Strength 六角訓練啞鈴(4kg)\r\n', 3, 3, '', '504,864,1224,1764,2210', '2021-07-04 11:28:00', 1),
(23, '【CHANSON 強生】彩色鑄鐵六角啞鈴(2支入)', 3, 6, '', '480,700,960,1160,1300', '2021-07-04 11:28:00', 1),
(24, '【強生CHANSON】電鍍啞鈴(雙入)\r\n', 3, 6, '9&10KG*2入\r\n高級電鍍+防滑握把，握感舒適\r\n最簡單方便的健身器材', '2100,2400', '2021-07-04 11:28:00', 1),
(25, '【Fun Sport】競技壺鈴', 3, 7, '全身性運動，激發核心肌群及爆發\r\n重訓/復健/運動\r\n多元訓練變化，打造完美線條', '2341,3024,3278,3745', '2021-07-04 11:28:00', 1),
(26, '【Fun Sport】健力環-乳膠環狀彈力阻力帶', 3, 7, '輔助健身訓練,引體向上\r\n爆發力及肌耐力訓練\r\n增加重量訓練的強度\r\n什麼是彈力帶\r\n\r\n可以調整關節和提升肌耐力，減少關節的壓力。因為有提升肌力的效果\r\n\r\n故有健身教練拿來做為肌力訓練的工具，至今已有好久的歷史。\r\n\r\n彈力帶材質有乳膠、TPE等膠類材質\r\n\r\n利用其彈性、韌性來訓練肌肉的伸展延展進而強化提升肌耐力。\r\n\r\n彈力帶種類\r\n\r\n長度約120M的彈力帶，因應健身訓練的不同需求，演化出有更長約\r\n\r\n180~250M的規格，因為其阻抗運動依照肌肉出力的程度\r\n\r\n又分為厚度如0.35m~0.95m，愈厚的需要更使力，反之薄的力量\r\n\r\n即較小，一般女生使用的會比較薄，或者依照訓練的進度來漸進更換強度。\r\n\r\n在外型上，除了長條型，還有圓圈環形的彈力帶\r\n\r\n如『樂訓環』、『捷力環』、『大力環』、『健力環』這些產品\r\n\r\n直徑大小不一定，視運動教練課程的運用來挑選。', '531,801,972,1280', '2021-07-04 11:28:00', 1),
(27, '【Fun Sport】翹翹臀-不挑腿可調長度翹臀圈', 3, 7, '不挑腿尺寸可調，一條搞定\r\n深蹲臀舉橋式練臀阻力加強\r\n採用親膚彈性布貼腿不滑動\r\n\r\n商品規格\r\n顏色 率性綠、美力粉\r\n尺寸 寬8CM，最長45CM平鋪測量\r\n附件 收納袋（一條一個）', '540', '2021-07-04 11:28:00', 1),
(28, '【Comefree】瑜珈防爆抗力球65cm(兩色任選)', 3, 8, '特殊防爆安全設計\r\n強化柔軟度的訓練\r\nMIT台灣製造 品質保證', '599', '2021-07-04 11:28:00', 1),
(29, '【Comefree】植纖系列瑜珈運動按摩滾筒-加長版(50cm)\r\n\r\n', 3, 8, '添加可回收之植物纖維\r\n加長型50cm滾筒支撐更穩定\r\n可做為瑜珈柱使用', '1062', '2021-07-04 11:28:00', 1),
(30, '【Comefree 超值組】羽量級TPE摺疊瑜珈墊+瑜珈伸展圈2入(四色可選)', 3, 8, 'TPE材質，無毒最安心\r\n羽量級重僅有640公克\r\nSGS檢驗合格，台灣製造', '999', '2021-07-04 11:28:00', 1),
(31, '【ON 歐恩】金牌乳清蛋白5磅', 4, 9, '5.5克BCAA支鏈氨基酸\r\n4克氨醯胺\r\n24克蛋白質', '1999', '2021-07-04 11:39:42', 1),
(32, '【美國 ON】金牌 WHEY 乳清蛋白', 4, 9, '優質的乳清蛋白,最佳高蛋白營養\r\n顧客評價極高的乳清蛋白\r\n富含分離乳清蛋白,營養高,吸收', '3399', '2021-07-04 11:39:42', 1),
(33, '【美國 ON】CREATINE 肌酸(600g/罐)', 4, 9, '運動員必備\r\n肌酸是目前最熱門的運動營養補充品，為許多健美及運動愛好者的最佳首選商品，建議可同時搭配高蛋白及高澱粉食物一起使用。\r\n\r\n肌酸最佳食用時間為運動前的30分鐘或者運動後的一至兩個小時內。\r\n食用期多喝水，可以促進肌酸被人體肌肉吸收', '899,1699', '2021-07-04 11:39:42', 1),
(34, '【Spark Protein】Spark Bite優質蛋白巧克力－4種口味綜合組(石臼抹茶、香濃牛奶、野莓派對、醇黑可可)', 4, 10, '榮獲iTQi國際風味1星推薦\r\n富含牛奶及大豆蛋白質\r\n減糖60%，每份僅含2.5g糖', '999', '2021-07-04 11:39:42', 1),
(35, '【Spark Protein】Spark Crunch高纖優蛋白脆球-隨手包(黑巧可可)\r\n', 4, 10, '無使用麵粉，降低精緻澱粉攝取\r\n10g以上優質牛奶及大豆蛋白質\r\n純烘烤非油炸，減油更健康', '49', '2021-07-04 11:39:42', 1),
(36, '【Spark Protein】Spark Shake 高纖優蛋白飲 - 玄米煎茶拿鐵 乳清蛋白(1kg袋裝)\r\n', 4, 10, '每份提供20g以上蛋白質\r\n頂級台灣研磨茶粉使用\r\n無添加糖、代糖及香精', '1350', '2021-07-04 11:39:42', 1),
(37, '【MYPROTEIN】Impact 乳清蛋白粉(黑糖珍珠奶茶/1kg/包)', 4, 11, '每份蛋白質含量高達 21 克\r\n4.5克BCAA 2 克亮氨酸\r\nLABDOOR評為 A 級產品\r\n\r\n\r\n【商品特色】\r\n\r\n乳清一份25g，蛋白質含量18~21g，熱量94~103大卡 \r\n\r\n \r\n\r\nImpact 乳清蛋白粉的產品設計\r\nImpact 乳清蛋白粉選用最優質的牛奶乳清原料，採用全天候青草餵養方式，每份含有蛋白質高達 21 克。產品中含有所有人體必需氨基酸，每份乳清蛋白粉還含有 4.5 克 BCAA支鏈氨基酸和 3.6 克谷氨?胺。本產品極易溶解和混合，可以被人體更好的消化和吸收。此外，每份 Impact 乳清蛋白粉僅含 1.9 克脂肪和 1 克碳水化合物。此款優質乳清蛋白粉口感極佳並具有非常高的性價比，如果您在尋找高營養價值的膳食補充劑，Impact 乳清蛋白粉是您理想的選擇。\r\n\r\nImpact 乳清蛋白粉的功效\r\nImpact 乳清蛋白粉服用方便，為您提供了高質量的蛋白質營養，可全天候促進肌肉的生長和維護，每餐份僅含103 卡路里熱量，Impact 乳清蛋白粉適合所有類型的運動從事者服用，也適合業餘、專業等各種水平的健身者。\r\n\r\n適用人群\r\nImpact 乳清蛋白粉適合各類運動員和健身人士，有助於達到訓練目標和優化健身效果，也適合需要增加蛋白質攝入量的人群。不論你是專業健身者還是業餘體育運動愛好者。\r\n\r\n服用時間？\r\n運動後人體代謝速率會大幅提升，Impact 乳清蛋白粉吸收快速，因此特別適合在運動健身後 30-60 分鐘內服用，也可在全天任何時候服用補充蛋白質。服用方法多種多樣，可以將蛋白粉和水或牛奶混合作為補充蛋白飲料服用，也可以和果汁混合飲用或加入希臘式酸奶中一起食用。\r\n\r\n \r\n\r\n【使用說明】\r\n\r\n在 Myprotein 搖搖杯中添加1大舀勺 Impact 乳清蛋白粉（約 25 克），和水或牛奶振盪混合後，即時飲用。為達到最佳效果，在健身運動前和/或運動後30分鐘內服用。(約包裝內附湯匙一平匙)\r\n加入可密封的杯子，以上下搖動的方式將乳清粉沖散即可飲用\r\n本產品也可以作為健康零食服用，或在兩餐之間補充蛋白質營養。\r\n建議一匙乳清搭配250cc左右的飲品(冷水/冰水/鮮奶等)\r\n如果在晚間睡前服用補充蛋白質攝入，我們建議將本產品和牛奶混合服用效果最佳。因為牛奶提供更慢的吸收速率，和乳清蛋白粉混合服用更有利於在夜間為人體持續補充營養。', '1199', '2021-07-04 11:39:42', 1),
(38, '【MYPROTEIN】英國 MYPROTEIN 官方代理經銷 燕麥乳清蛋白棒 18條/盒(巧克力豆口味)\r\n', 4, 11, '每條蛋白質含量高達23克\r\n含糖量比別人低,僅含2.8公克\r\n添加豐富燕麥,增加飽足感~\r\n\r\n產品特點 :\r\n每個蛋白棒含有 23 克蛋白質\r\n富含膳食纖維\r\n低糖\r\n\r\n產品介紹\r\n我們最新推出的燕麥乳清蛋白棒是一款美味又營養的酥餅類零食，適合需要在飲食中增加蛋白質和碳水化合物攝入的人食用。每88 克燕麥乳清蛋白棒含有從牛奶蛋白質和乳清濃縮蛋白混合物中提煉出來的高達23 克的蛋白質。其中的碳水化合物成分源自獨特的燕麥混合物，既營養又美味。\r\n\r\n在原有的燕麥乳清蛋白棒基礎之上，我們改進了獨特的配方，提升了口感，並為這個產品系列增加了兩種口感極佳的新口味。櫻桃杏仁和鹽焗焦糖這2 個新品絕對可以給甜食愛好者無與倫比的味蕾體驗，為您帶來充滿驚喜的甜蜜時光。\r\n\r\n燕麥乳清 蛋白棒的適用人群？\r\n無論是普通健身者還是馬拉松運動員都適合服用燕麥乳清蛋白棒。本產品是所有需要通過營養零食增加蛋白質攝入量的運動員或健身者的最佳選擇。運動員和健身者經常要面對緊張的健身訓練日程，蛋白質是所有運動營養補充品的重要組成部分。燕麥乳清蛋白棒可以輕鬆地放進包袋中，方便實用。', '1299', '2021-07-04 11:39:42', 1),
(39, '【米森】有機無麩質大燕麥片x4盒組(450g/盒)\r\n', 4, 12, '即沖即食，含膳食纖維\r\n完全熟化，細緻薄片、口感綿密\r\n無添加防腐劑、人工香料及色素\r\n\r\n「米森」特選來自芬蘭的有機純燕麥片\r\n獨特的冰湖地形，形成天然純淨的環境條件\r\n並利用春夏溫暖時期，引用無汙染冰湖雪水灌溉\r\n蘊育出麥香濃郁且飽滿的有機燕麥\r\n\r\n且特別從農場種植到加工過程中，嚴格執行完整的無麩質製程\r\n來確保有機大燕麥片符合歐盟無麩質(Gluten Free)規定\r\n並且全程通過有機驗證，給全家人雙份安心與保障\r\n ', '175,615,198,729', '2021-07-04 11:39:42', 1),
(40, '【米森】洋車前子殼纖維粉(180g)\r\n', 4, 12, '天然膳食纖維最佳來源\r\n無添加防腐劑、人工香料及色素\r\n富含膳食纖維增加飽足感', '285', '2021-07-04 11:39:42', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
