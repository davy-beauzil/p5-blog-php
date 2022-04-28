-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 28 avr. 2022 à 11:09
-- Version du serveur :  8.0.28-0ubuntu0.20.04.3
-- Version de PHP : 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p5_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `userId` int NOT NULL,
  `createdAt` bigint NOT NULL,
  `updatedAt` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `excerpt`, `content`, `userId`, `createdAt`, `updatedAt`) VALUES
(1, 'Exercitationem doloribus dolore molestias et sit sequi.', 'Fugit non tempore et iste. Eveniet dolore doloribus facere et qui et. Rerum reiciendis ut mollitia laboriosam. Ea nam natus velit doloribus omnis non accusantium.', 'Et velit quisquam vel nemo sit officiis placeat. Praesentium tempore quasi officiis commodi rem dolorem. Ratione culpa maxime aut placeat assumenda. Est omnis ipsam similique ea est consequuntur esse. Omnis laudantium voluptatem fugiat possimus sit eos quasi. Cupiditate et maxime minima iure porro rerum aliquam. Dolore dolor repellendus sint iusto sint ut nihil. Atque ad fuga doloremque architecto error ducimus earum. Et ex tenetur sint repudiandae eum quasi. Voluptatibus modi vero aperiam asperiores reprehenderit vel. Et est et et cum dolorum. Modi expedita magnam corporis delectus consequuntur placeat. Neque voluptas consequatur quia necessitatibus ratione cumque. In iusto sapiente rerum nesciunt dolores distinctio et. Dolores explicabo omnis molestias enim ut repellat dolorem dolorem. Eius beatae a voluptatem ut quia. Nihil et quod sequi. Repellendus et sed molestiae. A voluptatum numquam aspernatur esse non. Quos officiis voluptatem qui eaque. Iure est a exercitationem qui. Accusantium ut commodi in voluptas. Tempora tenetur reiciendis iste sit. Eum cum sed aut commodi repellat. Animi voluptates eius est voluptas quis deleniti voluptatem veritatis. Et quas laudantium saepe vel dignissimos. Distinctio odio aut dolor tempore saepe quaerat eos. Eligendi error earum veritatis a.', 6, 1649751527, 1649751527),
(2, 'Et sapiente eligendi et nulla non laborum.', 'Rerum blanditiis reprehenderit ut consequatur dolorem. Eos unde facere esse. Molestiae non nihil iusto consequuntur cupiditate. Aliquam non cupiditate tempora et et est ut.', 'Unde assumenda enim neque perspiciatis non sint aliquam. Ut aperiam dolores ipsum at eum voluptas ut ad. Id repellendus commodi et repellat tempora consequuntur illum saepe. Aliquam laboriosam sunt amet cumque voluptatem nihil provident. Minima neque vel cum officia. Repudiandae soluta nam perspiciatis repudiandae sunt cumque. Maxime aut at mollitia eum velit debitis. Cupiditate et a repellat rerum quae. Corrupti possimus rerum labore consectetur hic nihil dolores. Deserunt quidem error et quia. Quae deserunt recusandae placeat provident tenetur excepturi quis. Facilis culpa dolor velit quos necessitatibus qui. Voluptas sed voluptatem deleniti iusto eaque et nesciunt. Est deserunt enim quis ut incidunt. Alias mollitia adipisci velit natus et enim dignissimos odio. Quo sit et praesentium non sit occaecati. Sunt et dolor omnis beatae quo eos ab. Aut quas tempore cum earum. Magnam rem unde illum ad minus. Quas nam magni placeat. Error eum ipsa illum necessitatibus velit. Eveniet voluptatem fuga quos tenetur quas quam impedit. Ex tenetur sunt unde enim aliquid quas. Illum aliquam deleniti aut omnis.', 4, 1649751527, 1649751527),
(3, 'Quisquam velit est reprehenderit nam ut.', 'Unde dolore et expedita rerum nostrum et autem. Commodi deserunt ut et placeat. Quod et quaerat blanditiis in maiores qui ut. Nesciunt similique sed nemo reprehenderit consequuntur aut quisquam.', 'Vero consequatur magni qui eos doloribus id molestiae aliquid. Iusto odio quod delectus neque facere aperiam. Et quis ipsa neque sit. Vel aperiam aut quod blanditiis dolore. Qui veniam voluptatem laudantium esse veniam labore. Sint et dolore enim. Voluptate saepe harum et et fugiat. Saepe modi fugit sequi placeat ducimus libero quidem assumenda. Et velit optio sed ea earum non. Doloribus et aut sit animi voluptas quos repellat. Quod cumque non repellat sapiente recusandae. Incidunt sit quia consequatur voluptas vero alias. Qui sit aut explicabo rerum deleniti. Sed temporibus accusantium qui ipsa. Facilis eos vel aut repellat. Blanditiis deserunt esse maxime exercitationem ex culpa ipsum. Et nihil maiores quo quis veniam et eos. Et odio et consequuntur iusto mollitia voluptas aliquid maiores. Architecto a fuga dolorem quisquam aperiam suscipit sunt officia. Aliquid illum fuga voluptatem molestiae voluptas qui et officiis. Aliquid libero reprehenderit ad perspiciatis iusto natus voluptatem. Iste modi perferendis veniam ab error officia nihil. Blanditiis magnam quibusdam aut qui accusantium est. Quia qui eaque quaerat perspiciatis. Nobis culpa et est aut. Beatae sed qui cupiditate nisi qui corporis.', 23, 1649751527, 1649751527),
(4, 'Commodi est at voluptatum nostrum.', 'Sit consequatur fuga eaque corrupti provident doloremque culpa. Quos ea quasi eligendi reprehenderit. Omnis asperiores quae molestiae ea libero. Aut voluptatem aut animi nam eum rerum.', 'Odio cum illo ipsa voluptas voluptate aut. Quas ea nesciunt itaque possimus dicta. Impedit provident et necessitatibus recusandae. Officia iste aperiam sit tempore rerum quis. Est ipsam eius aut eius ipsam non dolore. Minus ab enim iure ipsam et quis porro. Molestias et consectetur possimus iste asperiores ut. Ut placeat eos corporis possimus fugit maxime est. Nam numquam ut non dolorum doloremque numquam. Dolor cumque qui mollitia saepe quos qui commodi optio. Totam qui maiores voluptate tenetur assumenda cum. Quidem excepturi et voluptatum qui veniam. Omnis similique magnam voluptatem ut voluptatibus.', 26, 1649751527, 1649751527),
(5, 'Soluta nisi esse nulla facilis aut facilis occaecati asperiores. Nisi aspernatur voluptate maiores non accusamus dignissimos.', 'Voluptatem eaque nulla et sit magni. Ipsum perspiciatis similique omnis culpa. Iusto sapiente exercitationem dolorem eius. Maxime enim adipisci dicta quia sit dolor quos. Eius et repellendus totam possimus ut sed.', 'Voluptatem iure debitis at aliquam non. Ullam omnis commodi dolor et ipsam sed. Aut molestiae repellendus rerum et eum delectus iure. Enim aut impedit et aut vel. A ut cumque doloremque ut aut deserunt. In veritatis molestiae quam architecto est. Ducimus corporis et est enim est. Rem est corrupti magnam reiciendis in est aut. Est facere odit est culpa. Et enim voluptate molestiae nihil omnis veritatis. Deleniti autem sunt quaerat laboriosam necessitatibus quo aut soluta. Eum quidem voluptas enim quod. Ullam placeat et similique ratione placeat. Aspernatur necessitatibus illo numquam velit ut totam. Ut ut consequatur quod in facilis quas. Consectetur non ea sapiente deserunt vel culpa omnis.', 16, 1649751527, 1649751527),
(6, 'Sit sed itaque quia eaque id expedita ex.', 'Repellat maxime omnis quos suscipit quia autem quaerat. Ut iste unde odit quas sit repellendus alias.', 'In voluptatem enim inventore non rem. Odio veritatis recusandae maxime voluptate. Et eligendi omnis est dicta recusandae. Non sit eos odit est et sit eaque. Quibusdam sed velit officiis optio. Consequatur et nemo incidunt assumenda totam cupiditate omnis libero. Mollitia dolor in ut aut ipsam vel sit. Sapiente debitis atque occaecati voluptatibus est perferendis. Eum dolorum sed tempora architecto et ex. Culpa aut facere sit eaque. Doloremque qui voluptatum iure quia mollitia sequi. Qui rerum vel voluptas ea vel. Expedita velit neque nulla dolorem velit et. Accusamus cumque exercitationem quisquam omnis. Deleniti magni et nisi in. Adipisci eligendi voluptas non est tempora aut. Perferendis a perspiciatis eum autem. Est fugiat expedita voluptatem aliquam accusantium. Sint atque qui est. Voluptate blanditiis ex omnis eos eos fuga. Qui quidem est voluptatem sed eum. Cum quam eveniet vitae. Possimus aut provident ducimus ea. Sint aliquid commodi facere reprehenderit sit ut repellendus. Facilis hic modi sequi id aut voluptas. Ipsum aut est unde sapiente facere et. Quis et sequi et unde asperiores. Deleniti consectetur neque hic excepturi eius aperiam.', 3, 1649751527, 1649751527),
(7, 'Eos laboriosam ad aperiam sit. Aliquid id excepturi aperiam dolorem non minus fugit.', 'Consequatur expedita et voluptatem in quisquam possimus aut. Distinctio voluptatem unde minus nemo sit provident. Delectus dolores rem distinctio qui. Exercitationem est hic quis sunt possimus exercitationem porro est.', 'Enim enim expedita quae aut quam quia molestiae. Unde porro esse vel nobis. Ut ex ea a deleniti aspernatur molestiae fuga. Fugiat accusamus impedit impedit ipsum velit. Soluta id quae temporibus est. Laudantium consectetur ut dolore culpa provident. Et et id ut ut expedita. Qui qui modi fuga et quia aut odio. Est vel mollitia voluptate sed iste. Reprehenderit alias minus odit sint omnis quas est. Ipsum ad numquam asperiores porro. Eum enim qui veniam tenetur qui ut. Enim recusandae sunt est voluptate provident ipsum nostrum. Ut ratione est sit adipisci impedit. Nostrum aspernatur omnis quis eligendi aut. Quae perferendis tenetur ea suscipit quo. Delectus quod dolorum eaque tempora porro non. Velit officiis iure dignissimos eos et optio. Quaerat voluptas magni eos. Sunt eos modi pariatur eius quo omnis et. Iure qui hic eos explicabo. Praesentium commodi consequatur reprehenderit nihil.', 15, 1649751527, 1649751527),
(8, 'Quae consequatur libero magni vero quo voluptatem fugit aut.', 'Neque eveniet ut sapiente ipsum atque. Velit sunt ut iure voluptas explicabo. Veritatis quas veritatis ducimus eligendi et distinctio corrupti. Ut pariatur quis at.', 'Dolorem cumque rem eum saepe dicta ut. Et veritatis est quia. Mollitia accusamus et qui id sunt totam. Expedita molestiae aut quisquam doloribus delectus. Odit fugiat animi nam fugit ea commodi minus. Dicta veniam enim iusto voluptas voluptatem. Qui sed est incidunt qui quibusdam reprehenderit non. Voluptatem sint hic non quas velit sit quod. Corrupti totam incidunt eveniet porro quaerat et modi earum. Aut nihil voluptatum eaque sit est. Beatae atque eos perspiciatis et ut laboriosam esse. Et sed ea deserunt quibusdam enim fugit. Laborum eius ea numquam similique animi non. Iure illum aperiam beatae quos esse maiores. Fugit voluptatibus quae reprehenderit architecto. Officiis at est minus nihil aut aut qui. Autem quas id et est. Labore et natus molestiae non. Exercitationem repudiandae fugit architecto totam odio. Esse rem minus voluptas. Non provident et eius dolor culpa soluta placeat. Sint voluptas quisquam veniam sunt. Consequatur recusandae recusandae ducimus minima odio quaerat ut nesciunt.', 21, 1649751527, 1649751527),
(9, 'Distinctio aut doloribus at nam est perspiciatis quod. Minus consequatur est voluptatem aut non.', 'Ea possimus qui vel alias quasi. Blanditiis quae ipsa aut quia fugiat reiciendis temporibus. Optio numquam voluptas tempore voluptatum totam.', 'Laudantium nesciunt sed mollitia consectetur. Quidem commodi maiores enim qui porro excepturi beatae. Est cum dicta non illo. Vero culpa neque iure harum quia molestias. Officia nostrum amet deserunt alias dolores. Ipsum totam suscipit sint corrupti voluptates numquam. Ea possimus animi nemo tenetur quibusdam dolor voluptates. Culpa nobis autem qui ab placeat. Recusandae omnis deleniti tenetur dolorem natus similique quod. Consequatur consectetur repudiandae perferendis iure delectus labore illum alias. Perferendis doloribus culpa hic. Rerum beatae odio repudiandae accusamus facere id. Vero hic quisquam qui alias nesciunt quos aut. Aut beatae sit sint enim ea nemo. Illo maxime qui harum unde beatae et. Molestias beatae est quas ut. Cumque ut est sint minus consectetur autem. Maxime commodi eaque voluptatem qui quo quis officiis. Nihil delectus consequatur perspiciatis delectus quos. Hic dolorum deserunt vitae molestias est. Vitae eveniet rem qui ut et vitae iste accusamus. Nam nisi et voluptas voluptatem dolor. Vero ut et molestiae aut. Quia facere voluptates vero. Suscipit atque aliquam eveniet ducimus necessitatibus voluptatem ea voluptatem. Quas consequatur deserunt dolore magnam amet. Id temporibus deleniti pariatur nemo voluptas. Et omnis aperiam accusamus voluptatem quas placeat. Veritatis ut omnis quos velit.', 3, 1649751527, 1649751527),
(10, 'Voluptatem voluptate et quo atque tenetur repudiandae consequatur. Eveniet qui aliquam eum et non aut illum.', 'Sed quis animi cumque quidem temporibus. Quam incidunt nesciunt in. Totam quaerat in commodi delectus consequatur.', 'Rerum molestiae ut enim facere et ducimus non quisquam. Quia quis fuga unde ut et et. Nihil illum nobis animi porro quia. Ut ratione magni similique qui et modi. Fuga reprehenderit quis culpa odit libero eos. Ut ipsum ut et molestiae. Non nostrum qui enim repellendus non. Qui ut inventore vel est rerum rerum. Ea et rerum ex. Voluptas nulla iusto perferendis quia eaque vel dolorem. Nemo et quidem magnam sint libero. Delectus quasi at eligendi laboriosam vero consectetur iste et. Quis ad et voluptates placeat ad. Qui repellat et qui ipsa. Non voluptates repellendus molestias. Voluptates fugiat consequuntur unde voluptatum dolores. Repellat nobis molestiae quo. Ab hic omnis illo repellendus aut. Aut voluptatem voluptate illum repellendus eveniet. Recusandae sint unde eius id id voluptatem. Quisquam animi similique eum exercitationem. Commodi occaecati consectetur ab dicta. Id repellat itaque iure itaque. Porro et sint eum consequatur. Ab aut dolorem id commodi exercitationem unde velit. Sit omnis provident est amet doloribus esse non. Molestias qui recusandae delectus sed qui. Vero et animi et sed quisquam atque eos.', 7, 1649751527, 1649751527),
(11, 'Suscipit expedita cupiditate eligendi et nemo. Aspernatur aut iusto est voluptates quos quia rerum.', 'Molestiae at asperiores libero provident commodi cupiditate corporis. Eius ut est assumenda aut incidunt excepturi ea. Deleniti ut nemo enim nisi libero qui.', 'Ducimus deleniti nesciunt quo nisi. Atque ut eaque suscipit et veniam qui. Cumque iusto quos doloremque repudiandae rem voluptatum. Ad reprehenderit voluptatibus sint autem ratione quaerat. Dolorem corrupti earum fuga vel ratione officiis et. Quod et quae molestiae accusantium quis consequatur sit. Dignissimos iusto debitis atque soluta commodi eum at. Repellat pariatur eius sint natus recusandae ut. Qui sed maiores facilis laudantium et. Est ut magnam ut. Officia voluptate ab molestiae qui quo nam. Nesciunt ipsum sapiente nostrum nihil. Consequatur ut dolor sed omnis quae.', 22, 1649751527, 1649751527),
(12, 'Voluptas non commodi recusandae optio.', 'Sint sint alias nihil vel velit sequi. Dolorem minima quo quisquam tenetur eos fugiat ut. Sapiente inventore qui corporis eaque. Quia deserunt excepturi ipsa est.', 'Ab dicta pariatur quia et incidunt. Dignissimos quo asperiores error qui animi repellendus. Officiis similique dolor dignissimos autem pariatur repellendus et. In mollitia vitae dolorem error dignissimos a. Possimus libero iusto incidunt molestiae. Pariatur et quae nihil omnis assumenda. Voluptas magni qui inventore voluptas alias inventore nisi. Aut fugiat et dolores quaerat blanditiis. Repudiandae error quas aliquid ipsum. Tenetur dolore iusto voluptatem. Quo voluptates quisquam ullam eius sit quis. Labore quis voluptas cumque pariatur laboriosam dolorem. Omnis sed quo omnis beatae. Molestiae error quaerat mollitia aut odio est totam. Praesentium autem quod libero asperiores eveniet. Sed est ut necessitatibus perspiciatis ea cumque. Ratione id odit ad impedit. Reiciendis optio alias non nihil quibusdam at dolorem. Eius doloribus quidem ut sapiente. Alias et sapiente corporis. Neque quasi minus quaerat nihil possimus praesentium accusantium. Nihil facilis cumque quam rerum repellendus aperiam ut. Impedit vero ratione voluptatum eos quod quibusdam. Culpa rerum necessitatibus et. Iste unde facilis saepe quidem enim perferendis. Possimus in corporis porro explicabo quasi aperiam quia.', 17, 1649751527, 1649751527),
(13, 'Omnis rerum nesciunt fuga autem.', 'Et similique laboriosam debitis labore aut nihil exercitationem occaecati. Aut dolorem aut magnam iste. Autem est consequatur quia molestias et omnis.', 'Est unde molestias ducimus autem sequi officia. Eaque consequatur velit quasi at et. Omnis ut corrupti minus veritatis quasi. Ut tempore molestiae doloribus odit ut dignissimos atque enim. Minus eos eius sapiente et culpa aut blanditiis. Consequatur in expedita quasi laborum ad alias. Sit molestiae velit porro quisquam. Iusto adipisci et rem maiores qui. Magnam nisi minima dolorem magnam. Dicta quia cum quibusdam et facere ex quia. Fuga occaecati molestias explicabo placeat in. Cum deleniti iure unde dolorem possimus quidem. Qui facilis magni consequuntur maxime autem nobis. Sed suscipit dolores rerum consectetur fugiat dolores amet rerum. Maiores quia at et quia et. Est rerum cumque culpa ea est perferendis. Maiores quo alias quis voluptatem id reiciendis soluta. Dolor enim recusandae nihil sed harum nulla et. Placeat dolor est veritatis voluptatibus et officiis. Consectetur perspiciatis qui libero nihil dolores aut. Corrupti eveniet adipisci consequuntur. Dolor ratione optio vel ut. Ratione et ut nam non et quaerat impedit. Dolor ut quasi facere quis ex eaque aut. Dolores velit adipisci est dicta velit delectus dignissimos. Soluta sit excepturi blanditiis perspiciatis impedit harum quibusdam. Non dolorem non ea labore vel. Ullam ut neque ad adipisci officia consequatur.', 17, 1649751527, 1649751527),
(14, 'Saepe provident dolorem est.', 'Et molestiae exercitationem architecto aut. Laboriosam consequatur et voluptates qui. Soluta eum et iure reprehenderit aut ea dignissimos veritatis. Nesciunt assumenda deleniti incidunt voluptatem occaecati in. Qui laboriosam facere sapiente.', 'Vel odio facere possimus odio aut. Quod et iure voluptatem. Qui voluptatem deleniti facere maiores voluptatem. Cum quaerat rem itaque. Facere dolorem veniam nesciunt magnam non eum esse consequatur. Illum velit odit facere voluptatem earum sint atque. In laborum eius et sed voluptates quo. Sit voluptates fuga quia amet et ad nostrum. Rerum occaecati molestiae asperiores soluta molestiae sint molestiae. Voluptatem aliquam qui quia quidem. Delectus ratione dolores magni non. Laboriosam corrupti delectus quo corporis minus animi. Omnis aut et veniam similique laboriosam. Sint omnis molestiae id ut. Illo quo sint quisquam. Reiciendis et in aut aut eveniet. Necessitatibus ratione rerum dolores sed recusandae vel. Enim possimus iusto nobis quis vero animi quibusdam est. Deleniti ipsum ut corporis enim corporis voluptatum. Corporis vero iste officia impedit. Molestiae cumque repellat vel ipsam. Et dicta magni tempora ex ad ullam ratione. Est aliquid qui nostrum corporis dicta sed eius.', 4, 1649751527, 1649751527),
(15, 'Quidem mollitia et aut assumenda adipisci et corrupti ipsa. Expedita voluptas eum accusantium consequuntur optio veniam.', 'Unde omnis et odit. Id unde explicabo odit non natus. Magni cumque ut numquam hic sunt qui. Reprehenderit omnis nemo deleniti ut quasi nihil minima sit.', 'Perspiciatis reiciendis est debitis culpa voluptatum sit laboriosam. Aut dicta maxime molestias sequi. Quia quia fugiat esse iste aspernatur quia. Voluptate reprehenderit aut consectetur sed est quibusdam. Necessitatibus dignissimos facere et laudantium voluptas quo voluptas. Saepe delectus exercitationem commodi quas quisquam. Et laborum et ea non sit. Quibusdam quia occaecati maxime. Molestiae id fuga harum odio recusandae. Cumque pariatur dignissimos ex. Non nisi incidunt deleniti et et. Nobis exercitationem soluta minus libero rerum nemo voluptate. Quo nam ut earum repellendus reiciendis. Fuga at occaecati distinctio provident quia enim. Soluta repudiandae omnis quisquam. Ipsum explicabo rerum et ea. Nemo illo sint quasi sint reprehenderit est. Accusantium aut et dolorum molestiae dolores consectetur. Ut tempora facilis rerum. Quam voluptatum unde impedit officiis ea. Veritatis ut animi qui dolorem eveniet et. Laboriosam voluptas voluptatum earum magni eaque vitae. Sunt est explicabo nulla aperiam sit quibusdam. Consequuntur odio quia vitae cumque rerum consequuntur adipisci. Eius assumenda laudantium aut voluptatem quidem voluptatibus. Et architecto dignissimos nesciunt vel.', 21, 1649751527, 1649751527),
(16, 'Voluptas quisquam voluptas veniam placeat voluptatem totam.', 'Porro magni sit sed ullam quo eveniet fugiat. At quibusdam incidunt illo in hic minima consequatur. Veritatis maxime enim blanditiis qui voluptatem iure voluptatem.', 'Voluptas est et optio eius corporis eligendi. Expedita dolorem perferendis laborum minus ea ratione eligendi. Labore voluptas et aut ut id aut. Et est ab nesciunt officia inventore. Deleniti cumque praesentium optio nulla voluptatem. In est optio ipsa quas voluptatem distinctio quibusdam. Rem dolorem qui quia hic eos. Cupiditate et cum rerum harum voluptas et consequatur. Tempora molestias eos vitae et enim. Pariatur quam deserunt sequi aut. Molestiae fugit laboriosam sit mollitia voluptatem. Placeat nemo doloribus voluptas asperiores. Porro eveniet quidem ratione adipisci consequatur. Praesentium adipisci quaerat quos ut suscipit voluptas. Qui est ea similique aliquam ipsam. Illo vel esse aut qui culpa id officiis aspernatur. Autem error libero cum mollitia suscipit aspernatur est. Facilis inventore nihil exercitationem dolorem voluptas. Totam ea aperiam velit et. Asperiores sint omnis esse qui consequatur sit perferendis. Veniam quis sapiente voluptate repellat sunt nulla eos. Nostrum nihil voluptatum enim. Amet laudantium sed harum excepturi. Aut in nam illum. Tempora corrupti maiores voluptatem omnis dolor quo. Totam vero quam iusto.', 14, 1649751527, 1649751527),
(17, 'Et hic laborum odio asperiores est id. Sit voluptates laborum ad rerum.', 'Natus ab sed itaque voluptatem porro fuga nulla. Eius debitis reprehenderit iure quisquam ut ipsam. Quis recusandae at omnis voluptas perferendis.', 'Iure quia enim facere aut sed nostrum rem. Quo placeat ratione quia eaque quo. Voluptas deleniti officia dolorem est dolorum. Aut corrupti quis explicabo error. Aliquid temporibus molestiae qui. Quia tempora quasi fugit maiores ad. Nobis assumenda vel provident est ipsa. Nam eveniet incidunt reiciendis. Placeat voluptas veniam sunt accusantium aliquam autem delectus. Voluptates dicta ut est ex dolorem placeat minima. Voluptatem provident dolorum deleniti explicabo quas facere ex. Sapiente quisquam quas ut dolor. Ea nihil dicta vitae tenetur consequuntur consectetur temporibus. Quasi aut rerum qui et error perspiciatis non magnam. Architecto voluptas officiis consectetur eos et sed odit. Error autem explicabo dolore explicabo rerum magnam. Quo maiores a aperiam velit magni rerum. Quis libero eius dolorem. Laboriosam sunt cupiditate qui magnam nobis. Dolore quo ut nesciunt officiis. Sit dolore placeat et exercitationem sunt ut consequuntur. Tempore enim consequatur rerum soluta et.', 15, 1649751527, 1649751527),
(18, 'Et enim sunt iure quod et. Aut tenetur incidunt culpa deserunt ipsa ad velit.', 'Reiciendis nihil non vel doloribus. Repellendus quasi labore dolor fugit quod. Odio quia rem labore ad voluptatum autem deleniti.', 'Tempore dolor quia porro omnis id. Suscipit aut fugit recusandae deserunt accusantium. Mollitia asperiores dolores id nihil aut. Cumque autem ipsam tenetur dolorem voluptatem qui recusandae. Esse recusandae explicabo illum repellat sed. Dicta autem iure eaque tenetur. Iusto ea ad autem qui a at repudiandae tempora. Unde et sit qui eos. Ut adipisci nulla nihil minima quo. Sunt autem quisquam incidunt. Beatae placeat necessitatibus aut voluptatem at odio nihil ea. Omnis animi quae odio voluptatibus totam. Aliquam veritatis quibusdam fugit est consequatur ut. Vero voluptates rerum eum quasi. Perspiciatis est cum non molestiae dolorum alias. Aut non atque odit eligendi nulla qui reiciendis beatae. Et qui amet ab repellat voluptatibus occaecati. Reprehenderit placeat vitae qui dignissimos non. Nisi velit id corporis ut quas. Aut vitae accusamus alias dicta iusto qui corrupti. Repudiandae autem enim eius vel qui autem et placeat. Et sapiente et tenetur aperiam. Aspernatur ad dolorum nihil. Eaque praesentium corporis velit voluptatum exercitationem sed minima omnis. Accusantium facilis consequatur amet temporibus facilis in.', 7, 1649751527, 1649751527),
(19, 'Quaerat ullam nisi quia.', 'Et quia omnis qui numquam omnis eum rem laudantium. Neque sed dignissimos asperiores facilis molestias iure architecto esse. Nobis temporibus dicta minus in excepturi unde. Facilis eos molestiae rerum voluptatem ratione.', 'Aut et cum aperiam ut excepturi veritatis. Voluptatibus facere omnis perferendis accusamus et sunt beatae. Id aut voluptas eum earum. Enim consectetur pariatur voluptas. Sit molestiae et reiciendis consectetur adipisci nisi. Eum corporis reprehenderit aliquid quae quibusdam quisquam. Ea voluptas molestias ab ea. Ad qui saepe quae asperiores. Et sit nisi voluptatibus adipisci qui. Qui illo dignissimos sunt quidem nesciunt dolorum quia fuga. Praesentium est quasi aut consequuntur consequatur et. Eligendi rerum id enim rem. Qui similique provident dignissimos modi inventore quia. Incidunt enim vel quas quo ex debitis doloribus autem.', 6, 1649751527, 1649751527),
(20, 'Omnis repellendus inventore libero rem dolores recusandae vel molestiae.', 'Non excepturi hic culpa quia ipsam. Ut ea similique et quidem dolor eveniet impedit. Error mollitia id est dolorum amet assumenda minus. Nisi ipsum id mollitia fugiat deserunt inventore nam in.', 'Asperiores nam cupiditate pariatur suscipit earum iusto veritatis aut. Alias error et repudiandae ab id. Corporis est nobis earum et. Eos et enim id quisquam exercitationem dolores. Asperiores possimus qui nesciunt distinctio ipsum ut atque. Labore praesentium doloribus cupiditate et et. A qui consequatur eligendi omnis. Incidunt dolore qui tempora rem repudiandae. Pariatur dolorum sequi excepturi rerum rerum ipsam. Et ut et sed delectus omnis voluptatem. Dolor laborum dicta officiis voluptate facere officia est possimus. Vitae magnam aut saepe laborum architecto. Eum nesciunt ipsum quasi et fugit repellat tenetur et. Asperiores dolor impedit molestiae et. Et veritatis accusamus sint est consectetur magnam maxime. Aut velit corporis officiis aspernatur.', 7, 1649751527, 1649751527),
(21, 'Eaque rem maxime rerum itaque laborum. Rerum sapiente pariatur fuga.', 'Et molestias nesciunt nobis rerum quas officia. Et pariatur neque blanditiis nulla nam blanditiis accusamus. Nulla autem cumque est tempore perspiciatis rerum molestiae nisi.', 'Quidem et enim optio vel cumque enim itaque beatae. Odit quibusdam earum et necessitatibus aut voluptas. Voluptatem vel recusandae dolor ea. Sed modi qui est fugiat veniam voluptas. Quis necessitatibus nemo quas deserunt beatae non. Rerum et quia distinctio enim. Et ut autem sunt dolor. Doloribus reprehenderit excepturi facere incidunt illo dicta ut. Qui qui eligendi molestias cumque iste quisquam alias. Aut velit ea est. Asperiores molestias voluptates corporis sit accusantium perspiciatis accusamus. Excepturi eum aut illo maiores est tempora aut. Et impedit aspernatur facere aut minima reiciendis. Delectus repellendus accusamus facilis minus.', 26, 1649751527, 1649751527),
(22, 'Reiciendis sint vero quae autem vel nam porro et. Aperiam eum libero amet distinctio occaecati aut adipisci.', 'Qui alias quae incidunt quisquam consequatur omnis. Ea libero voluptatem rerum odit. Eveniet quis aut asperiores facilis. Velit optio tempore iure qui atque.', 'Itaque odit molestias ut ipsam et ut. Vel voluptatem id incidunt nisi hic. Ea ullam et suscipit excepturi tenetur. Repellendus id qui voluptatem voluptas. Non dolorem suscipit nobis voluptatem velit consequatur consectetur. Necessitatibus reiciendis sapiente ut et cumque. Amet voluptas et aliquam dicta nam dignissimos atque. Sit nostrum minima temporibus occaecati debitis ut. Ipsam quae dicta dolorem illo earum expedita et. Ratione quasi ea impedit aut fuga facilis sint corporis. Vel omnis non sint fugiat et. Est repellat magni soluta excepturi. Voluptate eius placeat enim et voluptates sint excepturi quibusdam. Aliquid maxime dolorum id tempore ullam. Dolorem quo sequi et molestiae molestiae placeat. Praesentium iusto optio reprehenderit architecto asperiores porro. Et soluta qui atque. Eius necessitatibus reiciendis a dolor aperiam. Autem dolorem assumenda est odit tempora rerum eos et. At ipsam iusto saepe enim pariatur at.', 26, 1649751527, 1649751527),
(23, 'Amet ratione quas adipisci explicabo velit eum quaerat aut.', 'Voluptates cum quae aliquid sit debitis non. Ut iure facilis consequatur dolore. In inventore dignissimos eligendi quam molestiae.', 'Quo esse voluptatem ratione. Quo quis voluptas ratione qui sit est. Illum sed sint rem et quis. Et voluptatum quae quae nesciunt. Ipsam explicabo aperiam tempore. Quod quia qui itaque ipsa veniam. Soluta autem totam et et est reprehenderit nemo. Adipisci odit corrupti id et. Ut voluptatibus quasi est ratione. Autem ad veniam deserunt saepe voluptate assumenda. Consequuntur sit nam sapiente velit dolorem laboriosam distinctio enim. Nulla eius illo qui quia aut. Animi nemo dignissimos id assumenda odio dolor. Fuga reiciendis nulla tempore est non et sunt numquam. Vel in voluptatem minima est exercitationem. Sit quod a ut veritatis repudiandae enim. Assumenda eum suscipit quisquam ut minima. Non non illo cum quos cum. Excepturi debitis expedita omnis ducimus. Deleniti quia atque adipisci esse quia quam. Quia nihil dolores aut deserunt ratione odit rerum. Quam delectus totam vel sint rem. Aliquam suscipit nihil aut consequuntur. Et aliquid velit maiores quasi est. Reiciendis ullam consequuntur velit sit. Iure aut deserunt praesentium aut quod est. Quis repellat quo modi odio ab perspiciatis nemo. Ipsa qui excepturi sed nesciunt rerum aut.', 21, 1649751527, 1649751527),
(24, 'Atque ex sit distinctio doloribus est.', 'Debitis explicabo id quam. Ut consequatur id et iste veritatis sunt sequi est. Culpa necessitatibus placeat soluta unde asperiores. Vitae quia ratione beatae magnam accusamus.', 'Rerum doloremque aut ducimus. Voluptas voluptatem ut exercitationem fugit aut. Quis quasi sed accusamus ullam. Quia debitis fugiat doloribus deserunt dicta ratione inventore. Itaque rerum reiciendis delectus nihil et nihil minima. Dolore consequatur excepturi tempore iusto nisi corporis nihil fugiat. Ea odit sequi veniam. Quam iure ut autem ullam nisi soluta magnam. Esse ut corrupti non libero. Dolor ut corporis repellat est commodi. Perferendis ipsum hic quisquam vel eaque ratione fuga. Molestias possimus quaerat aut dolores quaerat. Exercitationem voluptatem sint facere odit et quibusdam. Numquam sed distinctio culpa. Delectus consequatur aut qui magnam est debitis. Quibusdam sint dicta ut omnis. Nemo voluptas necessitatibus et vel minus. Eos cum nesciunt voluptatem. Doloremque enim cumque quam veritatis enim voluptatem eos. Accusamus quo quia dolor mollitia autem soluta. Nihil dolorem sed facilis vero. Unde sed aliquam repudiandae velit. Nostrum in consequuntur voluptatem provident beatae quaerat illum.', 17, 1649751527, 1649751527),
(25, 'Et mollitia ab delectus tempora incidunt ut iure.', 'Exercitationem adipisci odio dolore. Quo voluptate reprehenderit ut natus esse repellat.', 'Et ad aut est qui blanditiis quis suscipit. Praesentium corporis architecto est molestias. Aut unde id qui facere aut assumenda velit voluptas. Harum aut ut qui voluptas aut. Iusto rem eos impedit exercitationem explicabo. Aut commodi officiis quam rem ut. Quia aliquid vel voluptate nesciunt ut. Et a exercitationem eos veritatis minus eaque. Deleniti exercitationem minima iste aut. Ratione qui qui dolor architecto aut earum molestiae dolorem. Aliquid dolores adipisci totam aut quos officiis ullam. Earum asperiores ut et voluptatibus. Pariatur enim enim ut maxime ut omnis. Omnis magnam ratione natus nesciunt repellendus blanditiis. Dolor qui perferendis autem omnis nihil et sunt non. Ut enim voluptatem doloremque consequatur. Nostrum eligendi velit eum est temporibus et ab quasi. Neque tempore officiis ea quia. Ducimus culpa eum distinctio accusantium velit non. Hic dolor dolores consectetur aliquid illum qui quis. Qui voluptas voluptatibus est. Et mollitia beatae nihil animi. A libero quasi quis commodi perspiciatis ut. Ut eligendi expedita asperiores ab ad. Suscipit molestias quod illo culpa id omnis. Velit neque explicabo maiores quo ullam iste. Et nobis molestiae autem eum.', 16, 1649751527, 1649751527);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `content` text NOT NULL,
  `isApprouved` tinyint(1) NOT NULL,
  `userId` int NOT NULL,
  `articleId` int NOT NULL,
  `createdAt` bigint NOT NULL,
  `updatedAt` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `isApprouved`, `userId`, `articleId`, `createdAt`, `updatedAt`) VALUES
(1, 'Ut qui et voluptatum et quasi non voluptas. Ea ducimus nobis molestiae unde error quibusdam voluptatem est.', 0, 5, 11, 1649751527, 1649751527),
(2, 'Numquam cupiditate facilis quidem laudantium placeat ratione. Neque nihil modi possimus accusantium ratione quia et. Accusantium et ut assumenda adipisci non aperiam.', 0, 8, 10, 1649751527, 1649751527),
(3, 'Quisquam neque neque repellendus velit aut reprehenderit.', 0, 9, 8, 1649751527, 1649751527),
(4, 'Voluptatum et explicabo doloribus in perferendis. Perferendis aut qui atque eos aperiam et aliquam. Optio maiores earum aperiam eligendi perferendis necessitatibus repudiandae. Autem eum similique reprehenderit perferendis fuga corrupti.', 0, 6, 7, 1649751527, 1649751527),
(5, 'Fugit ab facilis expedita sit. Dolorem at cum quibusdam animi ea molestiae quisquam. Consequatur perferendis aperiam nihil.', 0, 22, 20, 1649751527, 1649751527),
(6, 'Voluptas ipsam ut dolorem aut et dolores.', 0, 2, 11, 1649751527, 1649751527),
(7, 'Dignissimos eos praesentium sit nihil et earum ut. Consequatur mollitia id repudiandae culpa non dolor et.', 0, 8, 16, 1649751527, 1649751527),
(8, 'Doloribus quis sequi aut voluptatibus voluptatem. Aliquid est incidunt saepe suscipit.', 1, 1, 25, 1649751527, 1649751527),
(9, 'Ut deserunt quo error est molestiae sed. In non asperiores veniam maxime voluptatum enim laborum.', 0, 16, 25, 1649751527, 1649751527),
(10, 'Quas perspiciatis eum omnis. Corrupti totam id repellendus aliquam dolor.', 0, 7, 25, 1649751527, 1649751527),
(11, 'Architecto sint ratione quod error quaerat.', 0, 23, 25, 1649751527, 1649751527),
(12, 'In expedita voluptatem consequatur enim et dicta.', 0, 13, 15, 1649751527, 1649751527),
(13, 'Qui ut sed expedita qui aut consequuntur dignissimos. Nemo odio vitae cum animi quia necessitatibus autem. Facere temporibus laborum nihil quia ex necessitatibus unde voluptatum.', 0, 14, 14, 1649751527, 1649751527),
(14, 'Nihil itaque maxime aspernatur ea distinctio non. Aut quidem praesentium consectetur quo eveniet aut nihil. Excepturi consequuntur illo tempora dolorem voluptates facere sit.', 0, 3, 25, 1649751527, 1649751527),
(15, 'Officia voluptatibus dicta est adipisci ut illo.', 0, 14, 16, 1649751527, 1649751527),
(16, 'Maxime est possimus placeat cum corporis recusandae. Non quae dignissimos perspiciatis et inventore. Modi ut sed sed commodi occaecati. Esse vel modi minima amet dolores aut pariatur dolorem.', 1, 1, 21, 1649751527, 1649751527),
(17, 'Et ut laborum qui fuga repellendus eos tenetur. Rerum hic et temporibus voluptatum cupiditate exercitationem sapiente. Laborum quam et in blanditiis consequatur occaecati.', 0, 19, 12, 1649751527, 1649751527),
(18, 'Ullam et provident possimus aut ea libero. Voluptas reprehenderit eius voluptate nam corrupti.', 0, 8, 11, 1649751527, 1649751527),
(19, 'Repellendus rem non neque fugit. Mollitia sapiente blanditiis quod non omnis accusamus ut non.', 0, 14, 8, 1649751527, 1649751527),
(20, 'Quia alias minus ipsam magni facilis facere. Omnis vel porro quo odio quaerat. Rerum officiis et et magnam beatae nostrum voluptatem.', 0, 2, 15, 1649751527, 1649751527),
(21, 'Non libero ea voluptas quia dicta aspernatur. Quis similique architecto iste laudantium.', 0, 20, 11, 1649751527, 1649751527),
(22, 'Id magnam pariatur voluptas quo aut dolores quae ut.', 0, 23, 21, 1649751527, 1649751527),
(23, 'Quis a sequi rerum similique.', 0, 4, 19, 1649751527, 1649751527),
(24, 'At enim dignissimos expedita eum et ea et. Dolor maxime et fugit facilis. Beatae rem consequatur repellat maxime.', 0, 15, 13, 1649751527, 1649751527),
(25, 'Consequatur tempora velit qui in.', 0, 26, 22, 1649751527, 1649751527),
(26, 'Expedita ad culpa dolores fugiat totam. Voluptas quos ut dolores ut. Occaecati aut a possimus.', 0, 23, 14, 1649751527, 1649751527),
(27, 'Deleniti tempora quia dolore deleniti. Dolorum quam nihil molestiae aut enim magni quasi sed. Doloribus non dolorum tenetur velit voluptas. Possimus dolorum consequatur corporis officiis odio assumenda dolores.', 0, 24, 18, 1649751527, 1649751527),
(28, 'Provident ut dignissimos perferendis.', 0, 4, 5, 1649751527, 1649751527),
(29, 'Veritatis maiores velit ut recusandae. Aut alias quaerat iure sapiente nesciunt repellendus quia. Consectetur nobis iste impedit itaque et.', 0, 25, 2, 1649751527, 1649751527),
(30, 'Corporis sit excepturi laborum cum. Expedita similique voluptate qui accusantium fuga excepturi.', 0, 20, 23, 1649751527, 1649751527),
(31, 'Error quasi non ratione recusandae sint quidem vel. Iusto consectetur ut aut beatae. Laborum doloribus nam suscipit quod.', 0, 16, 23, 1649751527, 1649751527),
(32, 'Ut asperiores asperiores reprehenderit rerum quo atque facere nihil. Animi totam earum natus iste accusamus voluptas et.', 0, 11, 5, 1649751527, 1649751527),
(33, 'Ab voluptatum tempore rem itaque quia iure. Reprehenderit omnis quia iure hic cum quidem.', 0, 4, 6, 1649751527, 1649751527),
(34, 'Et libero quaerat voluptas quaerat. Quis doloremque tempore ratione ex veniam et accusantium. Sed voluptatem esse velit velit molestiae.', 0, 2, 24, 1649751527, 1649751527),
(35, 'Quasi modi in non reprehenderit deserunt omnis ullam. Quisquam et voluptatem ratione laborum dolores est.', 0, 15, 13, 1649751527, 1649751527),
(36, 'Sed aut ex rerum sed voluptatem eos. Eveniet explicabo id debitis sunt distinctio. Molestiae qui omnis nihil repellendus esse earum et. Dolore assumenda a dolor nulla labore. Incidunt culpa corporis iusto iste velit.', 0, 18, 16, 1649751527, 1649751527),
(37, 'Porro ea voluptate perferendis possimus mollitia amet. Quisquam et eum consectetur qui. Aut molestiae similique eaque rem corrupti modi voluptas ut. Debitis similique eum ipsa beatae id sapiente et.', 0, 20, 20, 1649751527, 1649751527),
(38, 'Ut et nostrum voluptas eum. In voluptatem et et.', 0, 22, 6, 1649751527, 1649751527),
(39, 'Officiis velit autem est sequi. Perferendis et eveniet dolorem consequatur rerum vel.', 0, 5, 17, 1649751527, 1649751527),
(40, 'Voluptate quas hic velit neque eos assumenda. Quos harum laborum velit et.', 0, 3, 13, 1649751527, 1649751527),
(41, 'Temporibus sint consequatur aliquam sed. Et blanditiis labore dolore illum. Quisquam repellat quia voluptatem assumenda et.', 0, 24, 21, 1649751527, 1649751527),
(42, 'Non excepturi natus dolor iste error. Magnam ad voluptas quis placeat necessitatibus sapiente nihil. Mollitia qui laborum cum beatae est iusto reprehenderit error. Quo enim officia ducimus mollitia.', 0, 26, 17, 1649751527, 1649751527),
(43, 'Consequatur magni et optio numquam molestias aut. Ea dolores temporibus aut vero voluptas quia sint explicabo. Esse sint suscipit voluptas commodi sequi. Temporibus soluta et sed est velit et.', 0, 12, 14, 1649751527, 1649751527),
(44, 'Atque libero et aut ut fuga labore aut. Molestias cum tenetur reiciendis reiciendis consequatur facilis.', 0, 3, 4, 1649751527, 1649751527),
(45, 'Autem explicabo aut maxime aliquam sed ipsum architecto. Non dolor qui nemo aut et. Cumque provident ipsam quos aut deserunt blanditiis. Veritatis non et dolor voluptatibus et ipsum.', 0, 18, 11, 1649751527, 1649751527),
(46, 'Tempore magni at est animi saepe.', 0, 7, 1, 1649751527, 1649751527),
(47, 'Consectetur id enim enim debitis a. Quia laborum voluptas nobis. Reiciendis porro est velit voluptates. Numquam sit est est et unde. Iste voluptas est molestias eveniet debitis.', 0, 22, 19, 1649751527, 1649751527),
(48, 'Ab delectus dolorem exercitationem quia. Quidem qui quae quaerat sint animi laborum. Et voluptatem sed deleniti debitis quo quia. Est ipsa consectetur sapiente commodi.', 0, 11, 24, 1649751527, 1649751527),
(49, 'Omnis eum consequuntur quasi ipsa veritatis veritatis. Quos at amet mollitia rerum eligendi accusantium. Occaecati aperiam nisi optio atque.', 0, 14, 7, 1649751527, 1649751527),
(50, 'Dicta amet repudiandae delectus enim possimus laudantium illo. Molestias est eos et aut.', 0, 19, 1, 1649751527, 1649751527),
(51, 'Natus ut dolor vel enim id. Vero qui fugit facere quis.', 0, 5, 10, 1649751527, 1649751527),
(52, 'Et ratione dolorem in sed. Sit qui ut ratione quia ab aut aut. Necessitatibus perferendis beatae iusto perferendis reprehenderit et.', 0, 9, 24, 1649751527, 1649751527),
(53, 'Vel dolorem deserunt distinctio quibusdam aliquid in iste. Animi reprehenderit est et debitis. Eum temporibus et tenetur voluptatum quia.', 0, 9, 18, 1649751527, 1649751527),
(54, 'Ab laudantium culpa illum ducimus molestias quasi beatae. Est aut a et cupiditate eveniet inventore consectetur. Nisi nihil temporibus eum eum amet nam tenetur. Ea ea voluptatem est explicabo.', 0, 5, 1, 1649751527, 1649751527),
(55, 'Perferendis corporis voluptas reiciendis aut ut. Sunt dolores cumque eaque et sunt ipsum est.', 0, 5, 7, 1649751527, 1649751527),
(56, 'Ratione laudantium placeat voluptas repudiandae qui debitis. Architecto eveniet placeat culpa.', 0, 5, 19, 1649751527, 1649751527),
(57, 'Qui tenetur accusantium sed et et voluptas sapiente. Veniam consequuntur dolor repudiandae commodi magnam magnam.', 0, 11, 10, 1649751527, 1649751527),
(58, 'Voluptatem quam est et. Dolorem ducimus ipsum at.', 0, 5, 15, 1649751527, 1649751527),
(59, 'Blanditiis et iusto illum qui libero. Et doloribus ea ut incidunt modi laborum. Alias aliquam dolores mollitia nulla ut eveniet.', 0, 4, 2, 1649751527, 1649751527),
(60, 'Voluptatem fugiat incidunt quo ut cumque.', 0, 4, 6, 1649751527, 1649751527),
(61, 'Qui modi et aut tempora. Ut fugiat eius voluptatem explicabo ut. Inventore doloribus aut et aut pariatur.', 0, 19, 8, 1649751527, 1649751527),
(62, 'Id et architecto impedit sapiente. Ea corrupti illum qui praesentium ex.', 0, 23, 10, 1649751527, 1649751527),
(63, 'Sapiente error ut minima consequatur quibusdam autem. Veritatis et officia quibusdam.', 0, 8, 16, 1649751527, 1649751527),
(64, 'Qui eligendi repudiandae possimus ea inventore. Qui doloremque velit pariatur illum.', 0, 6, 5, 1649751527, 1649751527),
(65, 'Rerum optio quasi deleniti optio. Dolorem eos ratione ratione sunt vero nihil voluptatem. Sequi est impedit expedita perferendis itaque quaerat. Cumque corporis nisi rerum voluptatem tempore est.', 0, 8, 1, 1649751527, 1649751527),
(66, 'Esse architecto rerum impedit iusto.', 0, 13, 1, 1649751527, 1649751527),
(67, 'Nihil iure autem voluptates soluta. Ad ut quia reiciendis repudiandae numquam. Enim omnis est labore officiis placeat qui ut.', 0, 21, 18, 1649751527, 1649751527),
(68, 'Eveniet possimus porro qui est et laborum ullam.', 0, 21, 24, 1649751527, 1649751527),
(69, 'Voluptatem alias recusandae ut.', 0, 10, 13, 1649751527, 1649751527),
(70, 'Eum aspernatur dolor tenetur aliquam. Eligendi mollitia provident provident inventore.', 0, 12, 8, 1649751527, 1649751527),
(71, 'Accusamus aliquam ut autem officiis suscipit laboriosam. Quae id nemo corporis.', 0, 13, 21, 1649751527, 1649751527),
(72, 'Aut dignissimos perferendis itaque quam necessitatibus sapiente est. Dignissimos repellat rerum et aliquam aspernatur ut.', 0, 22, 22, 1649751527, 1649751527),
(73, 'Facere aperiam maxime quia sint repudiandae velit. Qui fugit sunt reprehenderit et autem molestiae.', 0, 18, 24, 1649751527, 1649751527),
(74, 'Illo provident cum similique. Nisi excepturi sit non itaque.', 0, 10, 8, 1649751527, 1649751527),
(75, 'Consequatur nulla et quos dolores vero. Aliquam vero fuga ad earum.', 0, 15, 23, 1649751527, 1649751527),
(76, 'Sed voluptatum ducimus explicabo blanditiis incidunt cupiditate assumenda. Natus et rerum fugit dicta eum fugiat sequi.', 0, 14, 10, 1649751527, 1649751527),
(77, 'Sint quis autem sunt velit. Et in voluptate numquam et. Dolor esse voluptatibus excepturi eos voluptates in. Placeat sed eligendi officiis commodi consequuntur. Et dolor quidem ab repudiandae est consequuntur culpa modi.', 0, 26, 23, 1649751527, 1649751527),
(78, 'Vero rerum qui doloremque et dignissimos eum. Quam ut molestiae et hic. Veritatis itaque consectetur aut sed est sed.', 0, 11, 16, 1649751527, 1649751527),
(79, 'Officiis ut aperiam et ducimus. Velit dolores quo qui aut soluta et.', 0, 4, 8, 1649751527, 1649751527),
(80, 'Libero omnis voluptate qui quaerat eligendi. Veniam consectetur architecto ipsam exercitationem sit consequatur consequatur ullam. Omnis recusandae consequuntur incidunt inventore facere. Culpa eveniet aut amet.', 0, 10, 3, 1649751527, 1649751527);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `message` text,
  `userId` int DEFAULT NULL,
  `createdAt` bigint NOT NULL,
  `updatedAt` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `firstName`, `lastName`, `email`, `message`, `userId`, `createdAt`, `updatedAt`) VALUES
(1, NULL, NULL, NULL, 'Et est voluptas et nam ad voluptatum quia quae. Natus qui quo eveniet ut. Eius culpa ut dolores voluptatem blanditiis fugit iure fuga.', 12, 1649751527, 1649751527),
(2, NULL, NULL, NULL, 'Enim assumenda unde sed facere. Doloribus quis id natus et doloremque sed nostrum. Totam perspiciatis et dolor beatae distinctio soluta. Quia sit ratione temporibus repellat similique qui ut cumque. Delectus deleniti laudantium odit aut facere. Corrupti et fugit eaque reiciendis quia rem. Aut modi dolor assumenda sit culpa aut vel.', 24, 1649751527, 1649751527),
(3, NULL, NULL, NULL, 'Quia beatae tempora beatae harum porro nostrum consequatur in. Quos consectetur repudiandae atque sit quam. Sed hic voluptas odio. Excepturi quam est sed sit omnis. Velit ipsum non et dolorem natus. Omnis ex reprehenderit autem exercitationem est assumenda qui consectetur.', 10, 1649751527, 1649751527),
(4, NULL, NULL, NULL, 'Sequi nisi exercitationem et perspiciatis aut numquam aliquam. Repellat at sunt et aliquam qui praesentium. Sequi quo cumque eligendi pariatur ratione maxime ratione. Consequuntur saepe rerum illo soluta. Exercitationem ut vitae at quas delectus distinctio commodi.', 25, 1649751527, 1649751527),
(5, 'Rosalee', 'Roberts', 'rath.hudson@hotmail.com', 'Quaerat sunt et quae quibusdam autem omnis. Et eos voluptatum magnam eum expedita voluptate distinctio.', NULL, 1649751527, 1649751527),
(6, NULL, NULL, NULL, 'Officia assumenda occaecati consequuntur laboriosam assumenda illum quisquam. Pariatur alias cupiditate voluptatem aut. Sequi quasi qui dicta molestiae eos. Voluptatum exercitationem necessitatibus est ea ut suscipit. Enim sit impedit sunt molestiae. Ipsa corrupti deserunt aperiam quae rerum. Harum aliquam quod doloremque aut in vitae.', 12, 1649751527, 1649751527),
(7, 'Jarrell', 'Hilpert', 'hermann.tia@yahoo.com', 'Quam et aut cum dolor nulla recusandae. At quia earum deserunt exercitationem est. Delectus fuga recusandae ullam molestiae.', NULL, 1649751527, 1649751527),
(8, NULL, NULL, NULL, 'Quo libero ullam et dolorum nihil. Fugit sit totam et vitae. Exercitationem voluptates explicabo aut qui ratione magnam fugit. Error consequatur ad minus accusamus. Praesentium in molestias ipsam.', 15, 1649751527, 1649751527),
(9, NULL, NULL, NULL, 'Possimus placeat alias nemo excepturi quia. In voluptatem illo natus aliquid quibusdam beatae ratione odio. Et rem nihil nisi est nostrum. Quos cumque illum explicabo quibusdam natus minima. Voluptas minus dolorem impedit quis explicabo.', 19, 1649751527, 1649751527),
(10, NULL, NULL, NULL, 'Ea provident commodi in animi id. Tempore et fuga eum laboriosam commodi. Ad qui aut qui deleniti ea laborum. Natus omnis quia cum ea et recusandae voluptatem. In ipsum quaerat odit ea tenetur unde.', 2, 1649751527, 1649751527),
(11, NULL, NULL, NULL, 'Fugiat neque quia hic sit.', 12, 1649751527, 1649751527),
(12, NULL, NULL, NULL, 'Neque aliquam consectetur beatae dolorem aut optio. Velit eveniet illum totam rerum deleniti doloremque quibusdam. Dolores repellendus culpa mollitia voluptas. Sequi quia molestiae voluptatibus explicabo.', 4, 1649751527, 1649751527),
(13, NULL, NULL, NULL, 'Voluptas error dolor unde eos maxime rem. Atque excepturi harum dolores et aut.', 2, 1649751527, 1649751527),
(14, 'Zaria', 'O\'Keefe', 'cferry@yahoo.com', 'Sit quam ut et ullam nihil. Ratione facilis et sunt sed fugiat. Similique nulla provident quidem soluta. Deserunt minus qui ducimus amet ipsa qui dolore recusandae. Ut accusantium molestias vitae.', NULL, 1649751527, 1649751527),
(15, 'April', 'Keeling', 'satterfield.leo@hotmail.com', 'Odio ut earum voluptatem dolor officiis officia. Eaque delectus qui ratione aperiam.', NULL, 1649751527, 1649751527),
(16, 'Everardo', 'Schiller', 'tyshawn73@ankunding.net', 'Dolores voluptatum quo dolor ut doloremque itaque. Error aliquid reiciendis autem ducimus et ut aliquam. Sed officia cupiditate ea autem sed. Consectetur impedit vel non facere. Quae non accusantium dicta vero sequi tempore optio.', NULL, 1649751527, 1649751527),
(17, NULL, NULL, NULL, 'Illum aspernatur qui aut et nostrum non provident qui. Omnis delectus ut architecto distinctio. Voluptas in rem sed ipsum quia quasi asperiores et. Dolorem dignissimos nobis officiis nesciunt. Aspernatur qui dolorem omnis aut culpa quam doloribus. Earum ut facere quae quia ipsum eius consequatur.', 22, 1649751527, 1649751527),
(18, NULL, NULL, NULL, 'Id voluptatibus at accusamus qui. Rem modi ipsa eius quisquam et ipsum.', 15, 1649751527, 1649751527),
(19, 'Robbie', 'Aufderhar', 'quinn.schowalter@gmail.com', 'Voluptatum atque aut quidem laborum aut et beatae distinctio. Sequi eius ut molestiae dolor perspiciatis. Voluptates corporis quisquam in ad voluptates soluta cum. Libero omnis officia sint aut voluptatem.', NULL, 1649751527, 1649751527),
(20, NULL, NULL, NULL, 'Ea qui et eligendi similique repudiandae suscipit non. Beatae deleniti velit consequuntur labore. Enim doloremque odit quia ipsum quod odio. Magni vel aperiam vero ut vitae magnam dicta.', 14, 1649751527, 1649751527),
(21, NULL, NULL, NULL, 'Qui sed autem sint et et. Perspiciatis sit animi voluptates impedit.', 21, 1649751527, 1649751527),
(22, NULL, NULL, NULL, 'Possimus vel dolorem voluptatum et. Est veniam mollitia sunt.', 14, 1649751527, 1649751527),
(23, 'Carrie', 'Senger', 'champlin.kaleb@hotmail.com', 'Architecto accusantium dicta officiis error ut. Illum aut iure eveniet quia.', NULL, 1649751527, 1649751527),
(24, NULL, NULL, NULL, 'Ut sunt voluptatum ut dolor dignissimos. Pariatur quibusdam voluptatem aut et delectus magni. Rerum placeat maiores qui in modi nobis consectetur error. Architecto ut laboriosam quasi suscipit nostrum. Nobis quo doloribus labore velit suscipit.', 1, 1649751527, 1649751527),
(25, NULL, NULL, NULL, 'Aspernatur in eum provident laboriosam sapiente dolor praesentium. Corporis autem nesciunt autem est fuga.', 18, 1649751527, 1649751527),
(26, 'Yadira', 'Hilpert', 'tgleichner@weissnat.com', 'Eaque rerum omnis soluta quia ipsam nobis ea. Est ratione delectus nisi explicabo. Quia rerum sit ut illum quasi.', NULL, 1649751527, 1649751527),
(27, 'Kaia', 'Jenkins', 'cleora.jast@hotmail.com', 'Non quas eum quia molestias sed nihil tempora a. Ab et in repellendus ut omnis ipsa. Numquam doloribus dolores quaerat nam quo. Rerum aut sit quo consequatur sed. Ducimus qui aut vel consectetur.', NULL, 1649751527, 1649751527),
(28, NULL, NULL, NULL, 'Incidunt nobis rerum esse ducimus sed quae.', 24, 1649751527, 1649751527);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `isValidated` tinyint(1) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `createdAt` bigint NOT NULL,
  `updatedAt` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `isValidated`, `isAdmin`, `createdAt`, `updatedAt`) VALUES
(1, 'admin', 'admin', 'admin@test.com', '$2y$10$cLAuTHzuNgqNy/wqmbL2IuctQS9J66IRdkAqZIGCtg4ZJ./IOVCbu', 1, 1, 1649751525, 1651136860),
(2, 'Ora', 'Aufderhar', 'bswaniawski@hotmail.com', '$2y$10$GCCzbpshsvZNWG/LLtoU/e2sLXMRg5w78ottAVNk61.euXxcZnFgO', 0, 0, 1649751525, 1649751525),
(3, 'Friedrich', 'Braun', 'kareem21@hotmail.com', '$2y$10$cISFJM1It0Nd7AzQpd269.252enLxhPPq7C4GPHDCqq/F8VjzOyOC', 0, 0, 1649751526, 1649751526),
(4, 'Margarette', 'Reichel', 'rempel.sim@yahoo.com', '$2y$10$smqQRLzHf7o./IRl.OAOEOhLjAyA50WROcMxm6oz1d44O5mKp2vdS', 0, 0, 1649751526, 1649751526),
(5, 'Lea', 'Kiehn', 'mara.thompson@gmail.com', '$2y$10$jU42yjoydG81u6LbAoY1AO5zL3Yd4afN3acOfXee3Kug9scNnIWLK', 0, 0, 1649751526, 1649751526),
(6, 'Rosina', 'Ankunding', 'rafael.rowe@yahoo.com', '$2y$10$jWGkBeD8FI8lO8ktN91AeOLgSi4DjD1wC24Q/Q8KFTx2GjdBTzm36', 0, 0, 1649751526, 1649751526),
(7, 'Aliya', 'Bailey', 'izabella95@yahoo.com', '$2y$10$CObLcSxk9nD9IOpBfOS2BOuOVwPc9X.aDXh6uHH7nOO.Zbo2lXI/W', 0, 0, 1649751526, 1649751526),
(8, 'Lowell', 'Pollich', 'billie.effertz@gmail.com', '$2y$10$gpZ/F43Q3eQke9OkzzNgveUawYVI3aQquLU.cLIPGnHEgYV3TJMCK', 0, 0, 1649751526, 1649751526),
(9, 'Mayra', 'Kessler', 'aimee.smith@thiel.com', '$2y$10$ErqUTcq91UHcdO6GdisN0.2yqKZGMPLmXlamlnRzSfYPpU0OJBzwG', 0, 0, 1649751526, 1649751526),
(10, 'Georgianna', 'Daugherty', 'lavina65@tillman.org', '$2y$10$NpC/wX2ly9r.gDgPzGcoVuDjrPi8SMWfGUn8k2xHXvdLUPws4TwfW', 0, 0, 1649751526, 1649751526),
(11, 'Marie', 'Kilback', 'geoffrey73@mcdermott.net', '$2y$10$S1WBe5jFrgnkOt7kt9Rlwe937mVI8/.JbrzK9laFLWdJmrrrMaoWq', 0, 0, 1649751526, 1649751526),
(12, 'Claude', 'Tremblay', 'elynch@yahoo.com', '$2y$10$/6oI4Te7zd4sCc/EfEeVp.jFG2R/h1tcsUnEzHxtkqd1fRIMwxR0K', 0, 0, 1649751526, 1649751526),
(13, 'Kody', 'Hahn', 'kuphal.jettie@schmeler.biz', '$2y$10$kvKbt63DGJmZdDCfVhCcU.10SYtAoOl4Gq4OaGY3QkDYGA.s8EIki', 0, 0, 1649751526, 1649751526),
(14, 'Mario', 'Kassulke', 'cicero94@hotmail.com', '$2y$10$ZfRiIoPNHYDqSKZ6cMCIpuQFVI9XeqpbJBxN2i/iwyrsbDkchngo6', 0, 0, 1649751526, 1649751526),
(15, 'Shany', 'Schuppe', 'thickle@wintheiser.com', '$2y$10$WaL0uy.rjBviT3/qTFHNAeR0eGTVIdG4fgAbwAnaSFI2.4JZJWZnu', 0, 0, 1649751526, 1649751526),
(16, 'Eryn', 'Gibson', 'pspinka@hotmail.com', '$2y$10$cfqaCelhjiQnccqlvbi/XumiAB85uZq4MA/lLMUfwEP7YRmuHTwbO', 0, 0, 1649751526, 1649751526),
(17, 'Floyd', 'Muller', 'ricky.hauck@yahoo.com', '$2y$10$Y9Ifjh63ig5W1pWWc30kcOCylq0hWDKEkLj7eVFtO.eCjdHtNKqwS', 0, 0, 1649751526, 1649751526),
(18, 'Jessica', 'Langosh', 'swaniawski.bradford@gmail.com', '$2y$10$rbELt6yzPxtEhGzxEL7douFMBJOCC4wFCbYinealdd3F9WoIDgb92', 0, 0, 1649751526, 1649751526),
(19, 'Shyanne', 'Nolan', 'homenick.orie@hotmail.com', '$2y$10$StWkTyiLfMmLhYav9skhzOkF/KEflOmmSc.586s6Bnqv.HNp8PqL6', 0, 0, 1649751526, 1649751526),
(20, 'Janice', 'Zieme', 'jwolff@mayert.biz', '$2y$10$q7vRR/kd9LpYV3cYFmo0EOiLfH5vnbWHGelKIzQBlGSYWaZlctJrq', 0, 0, 1649751526, 1649751526),
(21, 'Anna', 'Shields', 'jeanne62@simonis.com', '$2y$10$E.WQsrwArhSYNT28mCpwceC5NRlDCrDT6LBKfwgugy.I4V3k4clea', 0, 0, 1649751527, 1649751527),
(22, 'Keira', 'Durgan', 'jeremy.boyle@yahoo.com', '$2y$10$hRiITJb8wyFM8lMVeZvdIOshb/OvL.7RnElQ9QGQ/ww/jbRp3vmzW', 0, 0, 1649751527, 1649751527),
(23, 'Maximillian', 'Kunze', 'bobbie62@hotmail.com', '$2y$10$9af4rXS8R0aOaSvEJOQ2iOENQv5OOs3U6qL2ou0zI/Ihq3aC7j3Cq', 0, 0, 1649751527, 1649751527),
(24, 'Barry', 'Braun', 'columbus82@tremblay.com', '$2y$10$USlw0U1tVS1GFjg7hbRuJucTSc66WoLjWcImupC0XbNlBHmG1TR5y', 0, 0, 1649751527, 1649751527),
(25, 'Murray', 'Kautzer', 'hahn.laverne@bauch.com', '$2y$10$80llKb085HQjcTsnWVv5V.z8.goN62TACE7XgwhJki8JeoH.ixzbC', 0, 0, 1649751527, 1649751527),
(26, 'Mabelle', 'Mitchell', 'rstracke@ruecker.com', '$2y$10$58NXZRwhU90VTyhj2XYkF.FuRFfBijRli2SFr4mCYErUpQH.qtzPi', 0, 0, 1649751527, 1649751527);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `article_id` (`articleId`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`articleId`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
