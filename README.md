# Project học phần Công nghệ Web (CT275)

Học kỳ 2, Năm học 2023-2024

**MSSV 1** : B2105569

**Họ tên SV 1**: Lê Trương Ngọc Duyên

**MSSV 2**: B2111857

**Họ tên SV 2**: Trần Yến Nhi

**Lớp học phần**: CT27502

**Tên dự án**: Website bán trái cây

**SQL**
CREATE TABLE `products` (
    `pd_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `pd_name` varchar(255) NOT NULL,
    `pd_price` varchar(255) NOT NULL,
    `pd_info` text NOT NULL,
    `pd_image` varchar(255) NOT NULL,
    `cat_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`pd_id`),
    FOREIGN KEY(`cat_id`) REFERENCES `categories`(`cat_id`)
) ENGINE=InnoDB;

CREATE TABLE `categories` (
`cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`cat_name` varchar(255) NOT NULL,
PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB;


CREATE TABLE `users` (
    `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `user_name` varchar(255) NOT NULL,
    `user_email` varchar(255) NOT NULL,
    `user_psw` varchar(32) NOT NULL,
    `role` varchar(5) NOT NULL DEFAULT 'user',
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB;


CREATE TABLE `carts` (
    `user_id` int(11) unsigned NOT NULL,
    `pd_id` int(11) unsigned NOT NULL,
    `pd_quantity` int(6) NOT NULL,
    PRIMARY KEY (`user_id`, `pd_id` ),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
    FOREIGN KEY(`pd_id`) REFERENCES `products`(`pd_id`)
) ENGINE=InnoDB;

CREATE TABLE `orders` (
    `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `order_code` int(5) NOT NULL,
   	`user_id` int(11) unsigned NOT NULL,
    `address` varchar(255)	 NOT NULL,
    `phone` varchar(15) NOT NULL,
    `pd_id` int(11) unsigned NOT NULL,
    `pd_quantity` int(6) NOT NULL,
    `order_total` int(12) NOT NULL,
    `order_status` boolean NOT NULL default 0,
    PRIMARY KEY (`order_id`, `order_code` ),
    FOREIGN KEY(`pd_id`) REFERENCES `products`(`pd_id`),
    FOREIGN KEY( `user_id`) REFERENCES `users`( `user_id`)
) ENGINE=InnoDB;

<!-- Thêm người quản lý -->

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_psw`, `role`) VALUES (NULL, 'admin', 'admin@gmail.com', '000000000', 'admin');

<!-- Thêm loại sản phẩm -->

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Trái cây Việt Nam'),
(2, 'Trái cây nhập khẩu'),
(3, 'Quà tặng trái cây');

<!-- Thêm sản phẩm -->

INSERT INTO `products` (`pd_id`, `pd_name`, `pd_price`, `pd_info`, `pd_image`, `cat_id`) VALUES
(1, 'Nhãn lồng Hưng Yên loại 1', '155000', 'Nhãn Lồng Hưng Yên là một trong những trái cây đặc sản của miền Bắc nói chung và tỉnh Hưng Yên nói riêng. Tại nước ta, nhãn có nhiều dòng, được canh tác ở nhiều khu vực, tỉnh thành, trải dài từ Nam ra Bắc. Mỗi giống nhãn sẽ có đặc trưng chất thịt và hương vị khác nhau. Tuy nhiên, nhãn dùng để dâng vua chúa xa xưa, chỉ độc nhất là dòng nhãn lồng. Đặc trưng không thể sánh của giống nhãn lồng là chất thịt ráo khô bên ngoài nhưng mọng nước bên trong. Kết hợp cùng độ quyện hoà tinh tế giữa mật nhãn đậm ngọt cùng hương thơm thoảng phảng phất, tạo ra hương vị say đắm lòng người.', '65f84a57d8db5_nhanLongHungYen.jpg', 1),
(2, 'Mận An Phước', '75000', 'Giống mận An Phước được ghép từ mắt của giống mận Thongsamsri của Thái trên gốc mận xanh đường Việt Nam. Nhờ lai tạo có chọn lọc mà giống mận này rất không chỉ sai trái mà độ ngọt cũng đậm hơn giống cũ. Nhờ áp dụng kỹ thuật bọc nilon khi trái còn bé, tránh được sự tác động đáng kể từ môi trường và côn trùng. Trái mận khi lớn lên thường sở hữu hình dáng đẹp, lớp vỏ nhẵn bóng với màu đỏ thẫm quyến rũ. Bên cạnh đó, phương pháp bọc nilon trên cũng giúp nhà vườn hạn chế thuốc trừ sâu và bảo vệ thực vật khi không thật sự cần quá cần thiết. An toàn sức khỏe người tiêu dùng. Khi thưởng thức Mận An Phước, có thể cảm nhận được độ giòn tươi ngay từ miếng cắn đầu tiên. Mận mọng nước, ngọt thanh và thường vị ngọt sẽ đậm hơn khi vào mùa nắng.', '65f85209deab0_manAnPhuoc.jpg', 1),
(3, 'Đào tiên Ngộ Không', '205000', 'Đào tiên không chỉ nức tiếng bởi ngoại hình kiều diễm, hương vị thơm ngon mà còn nổi danh qua bộ phim Tôn Ngộ Không vang bóng một thời Thuộc giống đào lông, nên khi cầm trên tay trái đào tiên lần đầu tiên đã cảm nhận được lớp lông tơ mỏng mềm, êm ái. Chất vỏ mỏng hồng đào xinh xắn, đào tiên không chỉ được mua về thưởng thức mà còn thích hợp làm quà biếu và chưng cúng trong các dịp lễ cổ truyền. Có hai cách để thưởng thức đào tiên là gọt vỏ và cạo lông, rửa sạch. Khi thức miếng đào giữ vỏ sẽ cảm nhận được độ thơm thanh dịu nhẹ đặc trưng. Đào tiên có lớp thịt dày, khi ăn sẽ cảm nhận được độ mọng tươi trong chất thịt, kèm chút giòn nhẹ đan xen độc đáo. Trái có vị ngọt thanh, tinh tế. Đây cũng được xem là một trong những đặc điểm mà người lớn tuổi tại nước ta rất thích khi thưởng thức loại trái này.', '65f8528101255_daoTien.jpg', 2),
(4, 'Nho rượu Kyoho Premium Hàn Quốc', '395000', 'Nho đen Kyoho hay còn được gọi là nho rượu Kyoho có nguồn gốc từ Nhật Bản từ năm 1946. Nhờ chất vị cùng mùi hương đặc biệt nên được canh tác rộng rãi ở nhiều quốc gia, trong đó có Hàn Quốc. Cái tên Kyoho trong tiếng Nhật được hiểu là \"vĩ đại\" và \"ngọn núi lớn\", biểu thị cho kích thước và tiếng vang của giống nho này. Được lai chéo giữa hai giống nho Ishiharawase và Centennial của Mỹ và Châu Âu, Kyoho có hình dáng tròn đầy, sở hữu chất vỏ dày, dễ bóc cùng 1-2 hạt lớn ở phía giữa trong của trái. Khi thưởng thức, dòng nho này mang lại một hương vị rất đặc biệt, quyện hoà giữa ngọt đậm, xen chút thanh chua kèm hương thơm thoảng mùi rượu sake lôi cuốn. Bên cạnh hương vị, chất thịt của nho Kyoho cũng làm người ăn say đắm cõi lòng với độ mọng nước cao, mang lại thanh âm tươi mới cho vị giác.', '65f852db7007c_nhoRuou.jpg', 2),
(5, 'Lê Hàn K-pear', '180000', 'Khác với một số giống lê phương tây có dạng hình bầu và dài, Lê Hàn Quốc sở hữu hình dáng tròn, kích thước tương đối lớn cùng sắc vàng nhạt ngả nâu bắt mắt. Khi cắt ra, ta có thể thấy được lớp thịt trắng sữa, thưởng thức sẽ cảm nhận được độ giòn, ngọt, mọng và đẫy nước trong từng miếng cắn.', '65f85328d7d9a_leHan.jpg', 2),
(6, 'Sầu riêng Lão Nông (cơm sầu)', '580000', 'Sầu riêng có nguồn gốc từ Đông Nam Á sau đó mới được du nhập qua các nước phương Tây. Vào thế kỷ XIX, sầu riêng Ri6 đã được nhà tự nhiên học người Anh Alfred Russel Wallace mô tả tựa như \"một món trứng sữa nồng hương vị hảo hạng hạnh nhân\". Ở Việt Nam, sầu riêng Ri6 được giới sành đón nhận và thưởng thức khá nhiều bởi độ dày và ráo cơm, tỷ lệ hạt lép lên đến 40%. Khi chín đủ độ, thịt sầu riêng sẽ có màu vàng tươi, độ ngọt luôn đi kèm với sự béo ngậy cùng mùi hương quyến rũ đặc trưng.', '65f853661e736_sauRieng.jpg', 1),
(7, 'Cam sành hữu cơ Măng Đen', '60000', 'Khác với các dòng cam sành khác, cam sành Măng Đen có lớp vỏ cam sậm đặc trưng, bề mặt vỏ sần sùi, xuất hiện những mảng rám to, nhỏ khác nhau. Vỏ càng rám, cam sẽ càng ngọt đậm vị. Cam sành từ lâu đã được biết đến là dòng cam chuyên dùng vắt nước uống bởi chất tép đẫy nước, mọng tươi. Hương vị trái không thuần ngọt mà sẽ thiên hướng xen chua thanh kích thích vị giác, nhờ vậy mà sau mỗi lần thưởng thức sẽ cảm thấy vô cùng tươi mới và sảng khoái. Tuy vậy, khi bóc vỏ và ăn trực tiếp thì hương vị của cam vẫn rất ngon, không kém cạnh với các giống cam chuyên ăn như cam vàng, cam vinh hay cam xoàn.', '65f853b11fea4_camSanh.jpg', 1),
(8, 'Hộp quà trái cây HQ183', '789000', 'Hộp quà Tết cao cấp bao gồm: Dâu Hàn Quốc Joy Farm, Táo Juliet hữu cơ Pháp, Quýt Úc, Kiwi vàng Pháp, Xoài cát chu da vàng, Việt quất New Zealand (Hộp 125GR), Combo túi quà và hộp, Hoa và phụ kiện trang trí cho hộp quà', '65f8545a97176_hq183.jpg', 3),
(9, 'Hộp quà 2 tầng HT003', '1929000', 'Hộp quà gồm: Táo Ambrosia size 24 New Zealand, Táo Ambrosia size 100 New Zealand, Quýt 2PH, Xoài cát chu da vàng, Kiwi xanh New Zealand, Lê hàn K-pear size 8, Mận đỏ Mỹ, Dâu tây giống Mỹ size 28 (hộp 500gr), Nho mẫu đơn Hàn Quốc (chùm trên 1kg), Hộp quà 2 tầng, Hoa và đồ trang trí.', '65f854f74e343_ht003.jpg', 3),
(10, 'Táo Rockit New Zealand (Lốc 4 trái, 372GR)', '150000', 'Táo Rockit là dòng trái cây cao cấp được trồng chủ yếu tại Vịnh Hawke của New Zealand. Để thu hoạch được chất lượng trái tốt nhất, các kỹ sư nông nghiệp phải mất khoảng ba năm gieo trồng, chăm sóc, cho cây phát triển, đơm hoa và ra trái. Chính vì thế táo Rockit từ lâu đã được xếp vào danh sách loại trái cây nhập khẩu được ưa thích, chinh phục không chỉ con tim của người lớn tuổi mà còn cả trẻ em. Kích thước trái nhỏ, lớp vỏ ngoài có màu hồng đậm nổi bật, xen chút sắc vàng nhẹ nhàng tô điểm. Khi ăn sẽ cảm thấy độ chắc giòn của thịt cùng độ ngọt ngào trong hương vị.', '65f9abb1dea7f_taoRockit.jpg', 2),
(13, 'Ổi giống Đài Loan', '60000', 'Ổi Đài Loan là giống ổi mới được du nhập vào nước ta trong vài năm gần đây. Đây là giống ổi có nhiều ưu điểm hơn giống ổi ta nên được rất nhiều người yêu thích. Đều trái, ổi có hình dáng hơi thuôn dài, lớp vỏ xanh đều màu và bóng. Ổi có độ giòn ngọt tuỳ theo thời điểm và mùa vụ, tuy nhiên khi so sánh, độ giòn và ngọt của ổi vẫn hơn rất nhiều so với các dòng ổi ta thông thường.', '65f9aec6da367_oiGiongDaiLoan.jpg', 1),
(14, 'Thanh trà Thái Lan', '175000', 'Thanh trà có thể được canh tác và trồng ở nhiều nơi nhưng hương vị trái thanh trà ở Thái Lan vẫn được ưa chuộng hơn cả bởi chất vị ngọt nhiều hơn chua, kích thích vị giác. Khác với trái thanh trà ở nước ta, hình dáng trái thanh trà Thái Lan thuôn dài, hình bầu dục. Chất thịt của thanh trà Việt và Thái tương đối giống nhau, mọng mềm khi chín. Xét về hương vị, thanh trà Thái Lan có độ ngọt đậm nhiều hơn, khi thưởng thức sẽ thấy có một chút vị xoài, kết hợp cùng xíu đào, cam và quýt.', '65f9b2d35b9ca_thanhTraThaiLan.jpg', 2),
(15, 'Kiwi vàng Đài Loan', '225000', 'Kiwi vàng Đài Loan là giống Kiwi đặc biệt nhờ sở hữu độ ngọt đậm và hương thơm khác biệt. Kiwi vàng Đài Loan khi quả còn cứng ăn cũng không quá chua, ăn khi chín có vị ngọt đậm. Trái càng chín độ ngọt càng cao. Để thưởng thức được trọn vẹn hương vị, khách hàng nên ăn Kiwi Vàng khi đã chín mềm tay. Quan sát bên ngoài, Kiwi vàng Đài Loan vỏ màu nâu nhẵn, không có nhiều lông tơ xù xì. Bên trong quả có màu vàng nhạt, mọng nước và chắc thịt.', '65f9b2fe275fb_kiwiVangDaiLoan.jpg', 2),
(16, 'Mận đỏ Mỹ', '350000', 'Mận đỏ Mỹ chủ yếu được trồng ở Mississipi và miền nam nước Mỹ. Loại mận này có vỏ tím đỏ đậm rất nhiều phấn tự nhiên phủ trên bề mặt vỏ, kích thước Mận Mỹ lớn gấp 3-4 lần trái Mận Việt Nam Vỏ Trái Mận Đỏ Mỹ khá mỏng và giòn, thịt rất chắc nên cho dù quả có mềm một chút thì khi cắn vào vẫn cảm nhận được độ giòn của nó, thịt quả Mận Mỹ giòn, ngọt, thơm và rất nhiều nước, chỉ chua nhẹ ở lớp vỏ Khi cắn nguyên trái sẽ cảm giác được phần thịt dày ngập kẽ răng cùng độ đậm tươi. Chất vị có độ ngọt vừa, hậu vị thanh dịu lôi cuốn.', '65f9b3e9e21fc_manDoMy.jpg', 2),
(17, 'Nho mẫu đơn nội địa Trung', '235000', 'Nho Mẫu đơn là giống nho lưỡng bội, kết quả của sự lai tạo giữa giống Akitsu-21 và \'Hakunan\' (V. vinifera) do Viện Khoa học Cây ăn quả Quốc gia (NIFTS) ở Nhật Bản tạo ra vào năm 1988. Nhờ sự lai tạo có chọn lọc, nho mẫu đơn mang nhiều đặc điểm nổi trội như kích thước chùm và trái lớn, thịt không không giòn cứng như nho Mỹ mà kết cấu thạch, mềm tan như jelly. Bên cạnh đó, dù đậm vị nhưng vị ngọt của nho mẫu đơn không gây cảm giác gắt cổ, khó chịu. Thay vào đó là sự ngọt thơm tựa sữa. Đó cũng là lý do mà nhiều nhà vườn gọi giống nho này là nho sữa hay nho xanh sữa.', '65f9b40f92778_nhoMauDonTrung.jpg', 2),
(18, 'Sapoche', '85000', 'Sapoche hay còn được gọi là Hồng Xiêm, là một loại trái cây khi chín có vị ngọt đậm, mềm, mọng nước và thơm dịu. Đa dạng trong chế biến, sapoche có thể thưởng thức ngay khi quả chín. Thường được dùng làm sinh tố, bánh, chè và các loại trái cây tráng miệng hấp dẫn khác. Được canh tác thuần tự nhiên, trái neo cây đủ ngày, sapoche nhà Morning Fruit không chỉ yêu chiều vị giác, mà còn yêu thương cả sức khoẻ người thưởng thức.', '65f9b546b2dd7_sapoche.jpg', 1),
(19, 'LêKiMa Cần Thơ', '85000', 'LêKiMa, hay còn gọi là trái \"trứng gà\", là một loại trái cây rất phổ biến đối với người dân Việt Nam. Đặc biệt là các vùng nông thôn, nơi đây lêkima được trồng rất nhiều. Lêkima có hình tròn, hơi thuôn dài, khi chín màu sẫm, bên trong ruột có màu như lòng đỏ trứng gà, hạt màu nâu đen; khi ăn có vị ngọt, thơm và mịn', '65f9b5646de90_leKiMaCT.jpg', 1),
(20, 'Mãng cầu Xiêm', '95000', 'Mãng cầu xiêm ngày nay được canh tác ở rất nhiều nơi trên nước ta, nhưng ngon nhất vẫn là mãng cầu Miền Tây, được nuôi dưỡng nhờ thổ nhưỡng hài hoà của nguồn phù sa màu mỡ. Đây được xem là dòng thực trái đa dạng trong chế biến, vừa có thể thưởng thức được ngay sau khi cắt, hoặc kết hợp chút đá, sữa đặc và đường là có thể ra được món sinh tố thơm ngon đầy dinh dưỡng. Cứng trái khi còn xanh, và trái sẽ mềm dần khi chuyển sang chín đủ. Khi cắt mãng cầu xiêm ra sẽ thấy lớp thịt trắng muốt, phân thành từng tép múi không rõ rệt cạnh nhau. Khi ăn sẽ cảm nhận được độ nước mọng ứa ra thì chất thịt kèm xớ tươi, dai dai đặc trưng. Mãng cầu xiêm có chất vị ngọt ngọt, chua chua rất kích thích vị giác.  Với hương vị độc đáo này, vào dịp tết âm lịch, các chị, các mẹ thường sử dụng làm mứt để ăn và biếu tặng cho người thân trong gia đình.', '65f9b584c060d_mangCauXiem.jpg', 1),
(21, 'Măng cụt Miền Tây', '115000', 'Măng cụt là dòng trái cây nổi tiếng và được nhiều người yêu thích nhờ chất vị ngọt đậm, kết hợp cùng độ thanh tươi đặc trưng. Bên cạnh măng cụt miền tây, Thái Lan là quốc gia cung cấp măng cụt nhập khập nhiều nhất cho thị trường trái cây nước ta. Với thổ nhưỡng và khí hậu khác nhau, măng cụt Thái và măng cụt Miền Tây sẽ có sự khác nhau về hình dáng và hương vị. Không tròn dài như măng cụt Thái, hình dáng của măng cụt Miền Tây sẽ bầu bĩnh hơn. Bên cạnh đó, chất măng cụt miền tây sẽ láng và tím sậm, măng cụt Thái sẽ có màu nâu nâu và da cám. Kích thước cuống của măng cụt Thái sẽ dài hơn và héo do mất nhiều thời gian vận chuyển từ Thái Lan. Ngược lại măng cụt miền Tây sẽ có cuống tươi và ngắn hơn. Xét tổng quan hương vị thì măng cụt miền Tây sẽ có độ kích thích hơn vì ngọt đậm 8 phần và 2 phần xen chua diu. Măng cụt Thái Lan thường ngọt thuần, thanh mát.', '65fb94da84120_mangCutMienTay.jpg', 1),
(22, 'Giỏ quà trái cây G015', '965000', 'Giỏ quà Tết cao cấp bao gồm: Việt quất New Zealand (Hộp 125GR), Táo Rockit New Zealand Jumbo (Lốc 4 trái, 424gr), Xuân đào ruột trắng Úc, Quýt Úc, Kiwi vàng Pháp, Xoài cát chu da vàng, Dưa lưới Hoàng Kim, Giỏ mây Như Ý, Hoa và phụ kiện trang trí cho giỏ quà.', '65fad9f9e4c6c_g015.jpg', 3),
(23, 'Giỏ quà trái cây G001', '895000', 'Giỏ quà trái cây gồm có: Dưa lưới Hoàng Kim, Mận đỏ Úc, Kiw vàng Đài Loan, Quýt Úc, Táo Envy New Zealand size 100, Mận An Phước, Nho đen không hạt Nam Phi, Lê Hàn Quốc, Thiệp viết tay Morning Fruit, Hoa và đồ trang trí cho hộp quà.', '65fadd2e2d12b_g001.jpg', 3),
(24, 'Hộp quà trái cây HQ163', '509000', 'Hộp quà bao gồm:, Nho kẹo đỏ Úc, Kiwi vàng Đài Loan, Quýt Úc, Táo Juliet Pháp, Xoài cát chu da vàng, Thiệp viết tay Morning Fruit, Hoa và đồ trang trí cho hộp quà.', '65fadc801adc2_hq163.jpg', 3),
(25, 'Hộp quà trái cây HQ158', '1129000', 'Hộp quà gồm: Táo Juliet, Dâu Hàn Quốc, Lê Hàn Quốc, Quýt Úc, Nho xanh không hạt Úc, Việt quất New Zealand, \r\nHộp quà carton lạnh , Túi giấy đựng hộp quà Morning Fruit, Thiệp viết tay Morning Fruit, Hoa và đồ trang trí cho hộp quà.', '65fae4b3e29bf_hq158.jpg', 3),
(26, 'Hộp quà trái cây HQ119', '1129000', 'Hộp quà bao gồm: Dưa lưới Queen, Kiwi vàng New Zealand, Táo Rockit New Zealand, Lựu Peru, Quýt Úc, Nho đen không hạt Úc, Thiệp viết tay Morning Fruit, Hoa và đồ trang trí cho hộp quà.', '65fb94f1efea5_hq119.jpg', 3),
(27, 'Hộp quà xách tay HQ075', '449000', 'Hộp quà gồm: Xoài cát Hoà Lộc, Mãng cầu Bà Đen, Dừa gọt trọc, Cam vàng Mỹ, Xuân đào Úc, Hộp quà carton, Thiệp viết tay Morning Fruit.', '65fb9e7fcd42f_hq075.jpg', 3),
(28, 'Mận đen Úc', '295000', 'Mận Úc có rất nhiều loại nhưng Mận Đen Úc được săn đón hơn cả không chỉ bởi vẻ ngoài độc đáo, mà chất vị cũng ngon đặc biệt, khó quên. Kích thước trái luôn lớn hơn mận đỏ của Việt Nam, vỏ đen ánh xanh, bao quanh là lớp phấn trắng mỏng tự nhiên, bảo vệ trái khỏi những tác động của môi trường, côn trùng có hại. Khi ăn nguyên trái, sẽ cảm nhận được vị chua nhẹ của vỏ, đan xen, quyện hoà cùng vị ngọt tươi của lớp thịt bên trong.', '65fb958d7ccfb_manDenUc.jpg', 2),
(29, 'Cam Cara Mỹ', '125000', 'Có xuất xứ từ vùng Valencia, Venezuela nhưng ngày nay cam Cara được trồng rộng rãi ở khắp mọi nơi như Úc, Brasil, Bắc Phi và cả Mỹ. Kích thước cam cara khá to, hình dáng tròn đều, vỏ có ánh vàng tươi, ruột đỏ đậm, không hạt và mọng nước. Khi thưởng thức sẽ cảm nhận được chất vị ngọt tươi, độ ngọt vừa phải, không tạo cảm giác gắt cổ sau khi ăn.', '65fb9ba9b3da0_camCaraMy.jpg', 2),
(30, 'Túi quà nhỏ TM08', '269000', 'Túi quà gồm: Nho xanh không hạt Úc, Táo Juliet hữu cơ Pháp, Quýt Úc 2PH, Cam vàng Mỹ, Mận An Phước, Nho đen không hạt Úc/Nam Phi, Túi nhựa trong.', '65fb99548ee01_tm08.jpg', 3),
(34, 'Dưa gang Gia Lai', '45000', 'Nhờ thổ nhưỡng hài hoà cùng khí hậu lạnh, trong lành của Gia Lai mà dưa gang ở đây sở hữu được độ mềm mịn đặc sắc trong chất thịt. Dưa gang Pleiku có hình dáng tròn lủm, khi cầm cảm giác rất chắc và đằm tay. Với đặc tính vỏ mỏng, khi trái chín đủ độ, vỏ bắt đầu nứt nhẹ sẽ lộ ra lớp thịt xanh ngọt nhạt tươi tắn. Thưởng thức một miếng dưa gang trong miệng, vị ngọt dịu sẽ tràn ngập khắp khoang miệng kèm hương dịu thơm đặc trưng, lôi cuốn.', '65ffa412ec57b_duaGangGiaLai.jpg', 1),
(35, 'Bơ Năm Lóng', '95000', 'Bơ Năm Lóng thuộc dòng bơ sáp, hình dáng bên ngoài không tròn như bơ sáp cổ và cũng không quá dài như bơ 034. Bơ hình bầu dục, thuôn nhỏ dần về phía cuống trái, vỏ màu xanh và tương đối nhẵn bóng. Khi chín đủ độ, trái có độ sáp cao, vị ngọt dịu và hương thơm thoảng nhẹ béo ngậy trứng gà. Hạt bơ khá to nhưng vẫn đảm bảo được độ dày của ruột. Ưu điểm nổi bật của Bơ Năm Lóng là ít bị sốc nhiệt trong quá trình vận chuyển. Độ chín của trái tương đối đều, dễ bảo quản và tưởng thức.', '65ffa4bae1350_boNamLong.jpg', 1),
(36, 'Bưởi da xanh', '75000', 'Bưởi da xanh có nguồn gốc bắt nguồn từ tỉnh Bến Tre nước ta. Tuy nhiên với đặc tính dễ sống và phát triển ở nhiều điều kiện thổ nhưỡng khác nhau nên ngày nay bưởi da xanh đã được trồng rộng rãi ở nhiều vùng miền, trong đó có Bình Dương. Trái có dạng hình cầu, tròn đều, vỏ màu xanh và ngả vàng nhẹ khi chín. Vỏ bưởi mỏng và tương đối dễ lột. Tép bưởi chắc, hồng đỏ tự nhiên. Với hương vị thanh ngọt, mọng nước và tươi mát, bưởi da xanh ăn tươi không chỉ ngon mà còn sử dụng để ép nước, nấu chè, làm bánh.', '65ffa4e428294_buoiDaXanh.jpg', 1),
(37, 'Chôm chôm nhãn', '95000', 'Trong nhiều loại chôm chôm ở Việt Nam hiện nay thì chôm chôm nhãn vẫn được đánh giá là một giống ngon. Chôm chôm nhãn hay còn gọi là chôm chôm đường vì khi ăn thịt của chôm chỗm nhãn  giòn, tróc hạt, vị ngọt “như đường”, có mùi thơm đặc trưng và thời gian bảo quản lâu hơn so với các loại chôm chôm khác.', '65ffa5b3e0aac_chomChomNhan.jpg', 1),
(38, 'Thanh long ruột đỏ', '65000', 'Bình Thuận được mệnh danh là thủ phủ thanh long với số lượng và chất lượng trái bán ra trong và ngoài quốc tế đứng đầu nước ta.  So với thanh long ruột trắng, thanh long ruột đỏ được ưa chuộng hơn về cả ngoại hình và hương vị. Thịt của thanh long ruột đỏ có xu hướng mềm hơn và độ ngọt cũng nhiều hơn. Với hàm lượng nước, chất xơ và vitamin cao, thanh long ruột đỏ được xếp hạng vào nhóm trái cây đẹp dáng, bổ da của phái đẹp.', '65ffa5d2e5cf2_thanhLongRuotDo.jpg', 1),
(39, 'Xoài cát chu da vàng', '95000', 'Xoài Cát Chu Da Vàng được xem là đứa con mang trọn tinh hoa của vùng đất Cao Lãnh. Tương truyền rằng đây là thức quả tiến vua trong thời đại nhà Nguyễn lên ngôi, đó cũng là lý do mà giống xoài này còn được biết đến với một cái tên khác là Xoài Ngự. Khi chín tới, lớp vỏ xoài sẽ có màu vàng nhạt, hương vị ngọt xen chua nhẹ, kích thích vị giác. Khi chín già, lớp vỏ của xoài sẽ dần chuyển sang màu vàng đậm hơn, lan đều hết trái. Lớp thịt sẽ ửng vàng cam từ trong ruột ra, hương vị ngọt sâu, chất thịt mềm dai nhưng không mềm tan như xoài cát Hoà Lộc, hương thơm nhẹ dịu nhẹ đặc trưng.', '65ffa7877e442_xoaiCatChuDaVang.jpg', 1),
(40, 'Đu đủ ruột đỏ', '55000', 'Miền Tây từ trước đến nay nổi tiếng bởi những cù lao trái cây trù phú. Đặc biệt, Đồng Tháp luôn là địa điểm hấp dẫn trong những chuyến du lịch miệt vườn. Vì thế, Đồng Tháp được xếp vào một trong những vùng đất trù phú của các loại trái cây; đu đủ ruột đỏ là một trong số đó. Đu đủ ruột đỏ là loại trái cây trồng ở vùng nhiệt đới, có quả hình thon dài, kích thước lớn. Đu đủ mát, mềm tan trong miệng, mùi thơm thanh đặc trưng. Đu đủ mọng nước, dày thịt, có màu đỏ cam bắt mắt; vị ngọt đậm.', '65ffa7a868cb3_duDuRuotDo.jpg', 1),
(41, 'Vú sữa tím Lò Rèn', '105000', 'Với màu sắc bắt mắt, độ giòn thịt, lạ vị độc đáo, vú sữa tím bách thảo đang được thị trường ưa chuộng và các nhà vườn quan tâm để phát triển. Sự khác biệt lớn nhất của dòng vú sữa tím so với các dòng vú sữa khác là đặc điểm chất thịt của trái. Thịt sẽ được bắt đầu từ phần lõi trắng đến hết phần thịt màu tím nhạt bên ngoài. Nhiều người không biết thường chỉ ăn phần thịt trắng mà bỏ quên phần thịt tím ngọt. Trái có hương vị ngọt thanh, kết hợp độ giòn, khi ăn tạo cảm giác rất cuốn. Đặc biệt vú sữa tím khi chín sẽ không có nhựa, hạn chế tình trạng nhựa dính khoé miệng khi thưởng thức.', '65ffa7d991e62_vuSuaTimLoRen.jpg', 1),
(42, 'Mãng cầu Bà Đen', '95000', 'Mãng cầu hay còn được gọi là trái na, là loại trái cây được trồng nhiều nơi ở nước ta. Tuy nhiên, Tây Ninh được xem là thủ phủ của mãng cầu với hàng chục hecta đất trồng chuyên canh. Trái có kích thước vừa và lớn, khi xanh vỏ mãng cầu căng chắc, càng chín các mắt của trái càng mở to, có thể dễ dàng dùng tay bóc vỏ dễ dàng. Hương vị mãng cầu Bà Đen hơn hẳn các nơi khác về độ đậm vị, thịt ngọt mềm, dai nhẹ và không bị cát.  Hiện nay mãng cầu Bà Đen được canh tác không chỉ để phục vụ trong nước mà còn xuất khẩu ra thế giới. Với tiêu chuẩn trồng chuẩn VietGAP, chất lượng của trái không chỉ đảm bảo mà còn vô cùng an toàn cho người thưởng thức.', '65ffa7f4db3ab_mangCauBaDen.jpg', 1),
(43, 'Dưa lưới Hoàng Kim', '105000', 'Dưa lưới thuộc giống cây thảo hằng năm, có thân mọc bò, phủ lông ngắn, tua cuốn đơn. Nguồn gốc xuất phát từ Châu Phi và Ấn Độ. Dưa Lưới Hoàng Kim là một trong những giống mới, được gieo trồng ở nhiều tỉnh thành khác nhau. Với vẻ ngoài vàng kim tươi mát, dưa lưới hoàng kim không chỉ thích hợp để mua làm quà mà còn được trưng trong các dịp lễ, tết, đình đám. Như các giống dưa khác, dưa lưới hoàng kim cũng mọng nước, ngọt thịt  và tươi mát. Tuy nhiên, so sánh với dưa lưới queen thì độ giòn của dưa lưới hoàng kim sẽ nhỉnh hơn một chút và độ ngọt cũng sẽ thanh hơn.', '65ffa80e2cfdb_duaLuoiHoangKim.jpg', 1),
(44, 'Xoài cát Hoà Lộc', '139000', 'Xoài Cát Hoà Lộc không chỉ là đặc sản nổi tiếng của vùng đồng bằng sông Cửu Long, mà còn được xếp vào dòng trái cây xuất khẩu nổi tiếng của Việt Nam trên thế giới. Với những đặc điểm: mỏng vỏ, dày cơm, thịt mọng, chắc và không xơ, xoài Cát Hoà Lộc thật sự xứng đáng với danh xưng vua của các loại xoài. Khi thưởng thức, ta có thể cảm nhận được vị ngọt đậm, tuy đậm đà là thế nhưng hậu vị lại dịu dàng, không gây gắt cổ. Xoái cát Hoà Lộc rất thơm, mùi thơm dịu ngọt như sữa, cảm nhận ngay từ khi cắt cho đến lúc thưởng thức xong thì dư vị vẫn vương vấn mãi không thôi.', '65ffa8355b048_xoaiCatHoaLoc.jpg', 1);
