-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2019 at 10:33 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-mvc-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `body` text,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `deleted_at`) VALUES
(1, 'Quisquam illo et recusandae rerum quo aut consectetur.', 'Fugiat et et possimus voluptas eum. Temporibus asperiores non doloribus sit facere omnis qui. Esse corrupti et nobis doloremque voluptatum. Molestias voluptatem ipsa consequatur minus ipsam.', NULL),
(2, 'Et id eos enim incidunt vel.', 'Earum incidunt ullam blanditiis vitae veniam. Eius aperiam omnis consequatur et. Aliquam fugit aut temporibus et deserunt. Exercitationem voluptas beatae adipisci velit illum delectus.', NULL),
(3, 'Repellat eum beatae nostrum quis rerum deleniti.', 'Est aspernatur beatae sequi facere in. Ducimus at eaque enim eius consequatur. Neque quas itaque dolor magnam temporibus officiis dignissimos.', NULL),
(4, 'Repellendus corporis necessitatibus rerum sequi.', 'Eius mollitia vero aut. Asperiores mollitia provident numquam voluptate quam. Occaecati neque illo aspernatur deleniti incidunt. Et laudantium consectetur fugiat nobis dicta.', NULL),
(5, 'Velit aliquam dolor voluptatem eius aut.', 'Quibusdam quam voluptas accusantium illo. Qui ab necessitatibus a dolore et nihil provident debitis. Aut ipsam nihil eum id quo corrupti qui. Quis expedita impedit labore est.', NULL),
(6, 'Dolorem perspiciatis architecto facere non ut eos quia.', 'Deleniti sint qui adipisci sit sit ea aut. Inventore et veniam eum quos.', NULL),
(7, 'At cumque rerum officia dolorum quia totam laudantium.', 'Vel voluptates eaque est sed. Tempora odio natus placeat cum. Deserunt quia reprehenderit ex. Quo aliquam enim et reiciendis qui in illo. Enim autem est quo harum.', NULL),
(8, 'Occaecati asperiores voluptas necessitatibus sunt totam illo aut.', 'Rerum laudantium autem et. Et fuga aut consectetur repellat minus neque. Occaecati inventore rerum ut odit.', NULL),
(9, 'Molestiae odit veniam rem dolores.', 'Corporis consequatur reprehenderit ut sequi vel. Nam repellendus dignissimos sequi fugit vitae harum inventore. Qui sit rerum fugit porro. Cupiditate deserunt est tenetur optio dolorem.', NULL),
(10, 'Quisquam ad voluptates molestiae id ut.', 'Quia molestiae omnis alias est. Ex dolor laborum cumque et harum neque a. Est exercitationem ut quis dolor. Maxime assumenda ad aspernatur ratione facere dolores.', NULL),
(11, 'Cumque veniam iusto ullam vel doloribus.', 'Harum dolorem molestiae explicabo laudantium optio et molestiae quasi. Ut accusantium quidem animi sint sed omnis sit ex. Est et velit iste sint deserunt aut.', NULL),
(12, 'Sunt et repellendus qui nihil autem ea eum.', 'Officiis voluptas ipsam earum corporis adipisci odit. Eum et iusto dolor nostrum commodi. Ex sunt deleniti minima aut.', NULL),
(13, 'Deserunt ut velit esse necessitatibus impedit assumenda.', 'Voluptas sunt sapiente qui nam voluptatem aliquid placeat. Sequi nostrum et qui vel quia consequuntur provident.', NULL),
(14, 'Qui necessitatibus aut commodi et eveniet voluptas.', 'Nemo sed rerum eos possimus iusto. Culpa sit aut at et. Eligendi ducimus magnam ut consequatur excepturi quo.', NULL),
(15, 'Qui harum molestias et fuga dolor culpa.', 'Ratione eum quod commodi nostrum fuga. Ipsa dolores qui officia id voluptate. Sunt corrupti itaque nihil enim omnis. Ducimus tenetur et qui qui.', NULL),
(16, 'Assumenda debitis aspernatur recusandae ut sunt quis.', 'Rem qui tenetur aut sunt dolorem omnis culpa cum. Ab aut impedit quasi dignissimos placeat. Qui quas ut ut porro accusamus.', NULL),
(17, 'Maiores expedita atque et reiciendis nesciunt eligendi similique est.', 'Tempore fuga neque ea. Soluta aperiam dolor nam qui. Enim rem velit quos quaerat et aut nihil. Beatae id voluptatum cum dolore.', NULL),
(18, 'Et qui voluptatem molestiae nulla aut quia quis.', 'Suscipit non in saepe ea aspernatur occaecati odit quaerat. Cumque esse enim est quisquam ipsa aliquid ut mollitia. Ducimus ad culpa tempora dolores quam sunt. Illo molestias aut voluptatibus.', NULL),
(19, 'Illo sed aut eaque quidem ratione minima unde quis.', 'Ex quo dolorem quia officia optio id culpa eos. Et exercitationem et dolores error.', NULL),
(20, 'Iure odio repudiandae quia.', 'Non reprehenderit quos hic pariatur facere hic. Possimus necessitatibus eaque accusantium aut et et libero. Aut illo libero velit qui.', NULL),
(21, 'Labore eos ipsum enim nisi mollitia.', 'Vel possimus qui est eum esse est voluptas. Adipisci et dolor rerum consequuntur. Nostrum ut accusamus sapiente. Iure esse sint doloremque corrupti nemo et quia.', NULL),
(22, 'Cumque atque magnam explicabo dolorem ab voluptatibus sit dolores.', 'Et cum asperiores repellat tenetur. Perspiciatis sit rerum aut omnis eos. Dolore laudantium tempore omnis illum. Vel voluptate animi facere eveniet.', NULL),
(23, 'Omnis saepe vel labore dolorum enim culpa sit.', 'Eligendi molestiae soluta et sunt. Doloribus nam assumenda adipisci molestiae modi at est. Sequi quam quasi accusantium ducimus.', NULL),
(24, 'Sit quidem commodi minus minima.', 'Commodi nulla enim et occaecati culpa nesciunt minus pariatur. Omnis architecto perspiciatis aut voluptate. Illum quod quis doloremque voluptatem possimus autem.', NULL),
(25, 'Voluptate aliquid quae eum voluptatem numquam.', 'Voluptatem officia voluptatem deleniti laborum distinctio. Corporis rerum occaecati necessitatibus qui quo. Mollitia quis quam aperiam temporibus officia.', NULL),
(26, 'Voluptatum odit est enim et aut.', 'Debitis in optio minus incidunt. Vero saepe qui facere est. Deleniti et ratione sit animi rerum recusandae dolores. Et quis dicta voluptatum repellat. Vitae officia autem eum sint quo.', NULL),
(27, 'Iste expedita rerum est ab eos magnam.', 'Ut et praesentium quo ut possimus possimus. Ea enim ratione dolorem. Qui quo aspernatur excepturi repellat aperiam nisi sunt.', NULL),
(28, 'Quasi quia vel qui ut omnis neque et.', 'Accusamus sint veritatis adipisci et. Quo adipisci est blanditiis laudantium. Asperiores dolorum optio corporis velit. Alias ratione soluta sunt rerum. Hic voluptas veritatis quos et rerum eum.', NULL),
(29, 'Ut sed dicta hic laborum.', 'Eos enim enim aut tenetur asperiores ullam nisi. Vel modi et non quis dolorem veritatis. Enim quae distinctio deserunt eos quod. Officia consequatur perspiciatis neque beatae.', NULL),
(30, 'Quasi explicabo sed earum possimus sequi quam.', 'Explicabo autem similique aut eos sequi eos porro. Animi fugit porro ipsam repellendus tempora fuga sit qui. Excepturi voluptas eos consequatur consequatur ex.', NULL),
(31, 'Odit ducimus in ut qui magnam rerum nam expedita.', 'Cum et rerum et dolorem eum enim aliquid modi. Assumenda eligendi in et aperiam molestias et mollitia. Dolorem voluptatem consequatur rerum non ut nihil ipsam fugit.', NULL),
(32, 'Eum aspernatur est dolore accusamus praesentium perspiciatis labore temporibus.', 'Qui aut cum nostrum adipisci qui. Ullam illum in culpa minus libero minima aliquam. Laudantium ea distinctio et.', NULL),
(33, 'Autem quo eos inventore assumenda ut qui.', 'Voluptates illum labore vero commodi sequi officiis. Qui quasi quod ratione fugiat odit. Veniam pariatur iste aut quo dignissimos officiis rerum. Reiciendis ducimus aliquid qui modi dolor est libero.', NULL),
(34, 'Fugit dolor et blanditiis aliquam.', 'Ut impedit voluptatibus perspiciatis quis. Occaecati et id possimus molestias sit assumenda ullam. Et quia sapiente consequuntur sit culpa.', NULL),
(35, 'Numquam harum beatae reiciendis consequatur dolorem quis rerum.', 'Sint voluptatibus in itaque rerum quidem eum suscipit. Nulla blanditiis at occaecati fugit nam cum autem. Praesentium sunt inventore optio a autem in quod sit. Aut eos voluptatum quia.', NULL),
(36, 'Reiciendis similique nesciunt exercitationem perspiciatis aut porro possimus.', 'Molestiae earum amet dolore quaerat vel omnis dicta. Est deserunt ut minus omnis possimus architecto voluptatibus. Rerum quibusdam aut corrupti est sint maxime ea.', NULL),
(37, 'Hic accusamus in ducimus dolore natus.', 'Autem minima et non odit commodi blanditiis ut. Velit sit aut inventore qui. Ipsum ipsam eius et sit. Aut quis id qui totam exercitationem quasi.', NULL),
(38, 'Optio aut ut magnam beatae deserunt.', 'Quis illum perferendis unde. Illo quis sint quos id voluptas eum libero error. Non assumenda necessitatibus voluptas aperiam possimus aut vel.', NULL),
(39, 'Occaecati ducimus et ut earum rerum aut sint.', 'Aut ut distinctio sint possimus. Officia ut voluptatem velit aspernatur et reprehenderit. Ab accusantium repellendus in.', NULL),
(40, 'Aut et et et autem.', 'Qui illo et aspernatur eius excepturi id suscipit. Sit excepturi pariatur culpa sit aut. Aut quia non aut optio.', NULL),
(41, 'Dolor quam explicabo ut blanditiis.', 'Et omnis fugit odio non illo reiciendis. In a et error rerum quia.', NULL),
(42, 'Iusto qui aliquid adipisci non soluta possimus qui.', 'Cumque distinctio illum consequatur in laboriosam optio. Maxime fugit repellat odit nisi quo. Quia aspernatur officia ea dolorem impedit occaecati qui sit.', NULL),
(43, 'Nam ab natus quia fugit quos commodi ratione.', 'Cupiditate saepe corrupti unde ut libero quod autem qui. Delectus tempore laudantium et reiciendis inventore corrupti ut. Doloribus rem iure ea eum. Aut officia est consequatur quia nostrum rerum.', NULL),
(44, 'Officia distinctio dicta consectetur.', 'Temporibus vitae modi sed alias sed. Vel eveniet et aspernatur molestias doloribus sed. Dolor quo officiis quidem dolore. Dolor recusandae quas incidunt quo.', NULL),
(45, 'Magni natus amet assumenda fuga asperiores rem laudantium.', 'Enim ipsum reprehenderit possimus rerum dolore. Et molestias modi debitis. Eum molestiae alias error hic. Quasi maxime beatae sed molestias sed.', NULL),
(46, 'Repellat praesentium repudiandae totam suscipit maxime.', 'Rerum repellendus voluptate voluptas explicabo facere. Nemo est aut cumque nisi sit quia deserunt. Exercitationem velit aut atque cumque pariatur. Qui aut qui dolorum et excepturi repudiandae.', NULL),
(47, 'Illo non necessitatibus porro voluptatem.', 'Reiciendis ex provident vitae aut aut. Et voluptates quidem sit sit et. Et dicta alias minima delectus eos id eligendi. Consequuntur quod totam ut at.', NULL),
(48, 'Laboriosam id magni iste qui voluptatem aut.', 'Placeat aliquam eveniet unde placeat. Delectus iste dolore voluptatem suscipit itaque. Ex tempore et magni et eos ut aliquam. Laborum mollitia eius consequatur dolore.', NULL),
(49, 'Soluta est eveniet fuga quod sed.', 'Commodi eos consequatur sit nobis. Perspiciatis neque rerum pariatur sit cupiditate ipsum minima. Quisquam sit numquam et amet occaecati qui sunt minus.', NULL),
(50, 'Pariatur reprehenderit veritatis non mollitia eaque et.', 'Tenetur sint ut dignissimos praesentium explicabo hic. Quidem veritatis asperiores laborum aut. Et nobis minus possimus omnis. Quod quod quos voluptatum perferendis eos exercitationem.', NULL),
(51, 'Aliquid delectus sint consequatur velit.', 'Expedita autem dolorum cumque voluptatem. Sed totam eligendi libero velit recusandae. Delectus consequuntur id consequuntur modi. Soluta reprehenderit dignissimos iste iusto dolore quia.', NULL),
(52, 'Alias qui delectus est et dicta.', 'Repellat pariatur aut quo modi quia. Est voluptas dolorum et non optio aspernatur et. Soluta et ea consequatur. Explicabo autem assumenda ut tempora.', NULL),
(53, 'Harum rerum possimus iste similique.', 'Magni sed exercitationem rerum perspiciatis autem odit. Quia in exercitationem recusandae ipsum aut. Numquam libero reprehenderit in est enim ratione porro culpa.', NULL),
(54, 'In voluptas dolore cupiditate consequatur aut.', 'Et qui voluptates animi est quia ipsum. Corporis qui velit id qui sed. Deserunt hic veritatis eius tempore quis.', NULL),
(55, 'Fugit eius quasi sunt ducimus quia rerum.', 'Doloribus et adipisci nulla consequatur architecto qui. Quod quo error non dolor. Molestiae aut possimus aut quos officiis id. Iusto molestiae fuga id reiciendis consequatur voluptatem maxime.', NULL),
(56, 'Dolor ab qui natus.', 'Quisquam tempore doloribus et amet. Et reprehenderit rem adipisci corporis molestiae. Porro excepturi et deleniti atque.', NULL),
(57, 'Recusandae placeat nisi ipsam impedit.', 'Eum inventore voluptas corporis fugiat voluptatem. Pariatur laborum corporis aut dignissimos commodi in porro ad. Iusto ea at molestiae possimus voluptatem ut. Nobis expedita sunt reprehenderit quae.', NULL),
(58, 'Aut iusto reprehenderit et rerum aut quod.', 'Aut doloremque enim deleniti sit. Corporis provident corporis molestiae quia sit neque debitis. Deleniti omnis placeat quod dicta accusantium rerum voluptatem.', NULL),
(59, 'Enim facilis et neque est nihil doloremque est sint.', 'Voluptatem veniam dolorem eum sunt dolores quam tempore. Officia dolorem cupiditate quia qui minima. Est sequi et dignissimos quibusdam voluptatibus voluptatem quia.', NULL),
(60, 'Totam nesciunt qui facere repudiandae.', 'Odit iusto voluptas cum. Amet sequi velit tempore velit.', NULL),
(61, 'Qui architecto et ad architecto corrupti fugiat.', 'In voluptatem provident dolore perspiciatis eum eaque asperiores. Libero incidunt magnam sint ducimus illum fugiat consequuntur sit. Natus unde dolor adipisci numquam. Esse porro alias aut dolor.', NULL),
(62, 'In sunt vel expedita id.', 'Quis sed cupiditate optio optio. Esse dolores perferendis quia quae labore labore. Ipsa eum iusto nemo est. Placeat sit accusantium esse molestiae.', NULL),
(63, 'Omnis corporis autem libero dolor soluta beatae est quis.', 'Odit provident neque eum ab. Sed ea qui aut voluptas. Voluptatem ut est voluptas id incidunt. Aut qui beatae est pariatur in corporis.', NULL),
(64, 'Quasi est quaerat rerum et nemo vitae.', 'Quas quaerat qui sit quisquam. Et velit quo nesciunt nobis. Et a omnis suscipit explicabo sequi. Et laboriosam aut iste.', NULL),
(65, 'Beatae temporibus et ipsum minima.', 'Voluptatem impedit ipsum omnis aliquid asperiores culpa. Explicabo rerum et explicabo est eum corrupti et. Modi et qui omnis qui et.', NULL),
(66, 'Quae et quia nobis et.', 'Sapiente recusandae nobis dignissimos distinctio ipsam. Pariatur sequi debitis amet et. Itaque facere sed est eius.', NULL),
(67, 'Molestiae doloremque exercitationem ut accusamus.', 'Perspiciatis sit eius ipsa. Pariatur et ea quo eveniet autem cupiditate. Veniam aut rem aut dolorum atque dolor pariatur.', NULL),
(68, 'Et sunt animi officia cumque porro.', 'Ut dicta rerum nisi voluptas. Unde delectus atque voluptas dolores iste quis accusamus. Vel dolor doloremque corrupti blanditiis. Culpa saepe tempore aliquam aspernatur repellendus veniam.', NULL),
(69, 'Deserunt dicta et nam ea.', 'Autem porro dolores quisquam dolorum quis magni suscipit. Ea explicabo est excepturi dolores esse voluptas fugit. Minima fugit aut expedita enim sunt architecto nihil. Itaque nam quaerat soluta sit.', NULL),
(70, 'Ea quia occaecati possimus officiis.', 'Ullam placeat voluptas et ut ullam debitis. Ut qui qui autem accusantium tempora illum qui doloremque. Quo nemo sunt et sed sunt accusamus laborum provident.', NULL),
(71, 'Quod consequatur officia qui minima in magni.', 'Tenetur cumque eveniet autem qui atque reprehenderit fugiat unde. Incidunt asperiores magni nobis. Magnam occaecati voluptate et aut.', NULL),
(72, 'Et rerum eaque qui.', 'Nostrum quis aliquid sint aliquam. Non cum aperiam ut sapiente aut est. Officiis reprehenderit molestias quis quia ab sequi sit voluptas.', NULL),
(73, 'Deserunt quo temporibus cumque et rem animi et.', 'Doloremque quaerat est eveniet ea labore esse quasi deleniti. Enim aut harum fuga. Repellat quis laudantium temporibus. Commodi voluptatem autem quidem sit est et.', NULL),
(74, 'Dolores et soluta nemo facere sint.', 'Laudantium inventore magni natus ex. Tenetur odit delectus dignissimos porro enim et alias. Consequatur aut dolor tempora eaque non odit. Rem est molestiae dolorum ut rerum.', NULL),
(75, 'Asperiores maxime molestiae voluptatibus exercitationem voluptate ducimus.', 'Mollitia officia quis enim nulla. Modi ut sunt illum porro sequi dicta veniam. Odio velit et possimus qui vitae qui molestias. Aut amet aut est quod.', NULL),
(76, 'Magni rerum tenetur culpa dolor.', 'Laboriosam quia earum labore ex fugiat quasi. Consectetur optio labore iste aliquam ut velit autem. Odio et aut sapiente quasi.', NULL),
(77, 'Nesciunt alias illo quibusdam eius at ad.', 'Harum labore quam ea quia ipsum officia sit. Voluptas excepturi laborum ipsum dolorem saepe. Omnis sunt atque laudantium commodi voluptatem unde et.', NULL),
(78, 'Ea nihil sunt cum rerum quasi voluptatum soluta.', 'Officiis corrupti molestiae nostrum qui. Est consectetur tempore sunt similique alias.', NULL),
(79, 'Fuga distinctio qui deserunt est occaecati soluta corrupti.', 'Qui doloremque velit excepturi voluptatem sit. Qui voluptate iusto numquam. Doloremque a dolorem veritatis. Quaerat sint ullam enim dicta est necessitatibus id.', NULL),
(80, 'Aliquam voluptatem eum provident veniam.', 'Voluptatem officiis rerum voluptate id itaque perferendis qui. Optio unde alias et omnis. Minus ut recusandae aliquid quas.', NULL),
(81, 'Quibusdam sunt et quo.', 'Cupiditate qui sit eaque quae doloribus. Ut dolor omnis odit praesentium provident quas quidem facere. Beatae quo enim aut odit labore fuga quis.', NULL),
(82, 'Voluptatibus id blanditiis at quas cupiditate nulla et similique.', 'Veritatis possimus dignissimos aut. Aut sed tenetur sunt. Laborum suscipit totam at veritatis accusantium.', NULL),
(83, 'Placeat quos mollitia facere in ipsum repellat doloremque.', 'Qui repellendus et non eos reiciendis distinctio maiores. Laborum odit veritatis officiis aut eius reiciendis deleniti. Eius in ut voluptas earum porro.', NULL),
(84, 'Maxime incidunt non incidunt aut.', 'Officia quo iste blanditiis quasi corrupti. Id tempore fuga voluptatem a. Asperiores ut et rerum aliquam quas. Id est vel ut ut velit. Dolor enim corporis tenetur aut dolor sunt.', NULL),
(85, 'Sed nisi sit temporibus voluptatum.', 'Saepe aut totam illum omnis. Minima rerum a ab laudantium recusandae illum. Et dolorum molestias ut sit sunt sint facilis. Est excepturi sint aut nobis consectetur alias et.', NULL),
(86, 'Voluptas ipsum voluptas sit blanditiis commodi.', 'Voluptate facere voluptatem laborum quis est quod iste. Et qui velit nihil. Accusantium consequatur nisi fuga sit atque voluptas. Quisquam corrupti inventore quo ut pariatur et est.', NULL),
(87, 'Nostrum cumque modi porro est.', 'Sed eius magni quam qui beatae eum esse. Facere autem temporibus quos suscipit illum ratione. Enim doloremque et dignissimos reprehenderit temporibus esse vitae. Hic autem aperiam error voluptatibus.', NULL),
(88, 'Soluta optio quo consequatur sint.', 'Iste et voluptas provident cumque et quam. Explicabo cupiditate labore alias et quam. Nemo rem occaecati soluta est neque dolorem.', NULL),
(89, 'Cum qui consequuntur consequuntur recusandae esse tenetur architecto enim.', 'Blanditiis eum sit eum amet quaerat consequatur itaque. Sapiente cupiditate aut eius itaque voluptatum. Labore ipsum nihil quis ex impedit.', NULL),
(90, 'Amet ipsa odit rerum reprehenderit odit.', 'Nemo tempore voluptas iusto. Deserunt illo blanditiis sed est ab. Quae eaque dolorum quia beatae.', NULL),
(91, 'Vero ipsa porro vitae et.', 'Impedit et dolore quia illum velit ipsam. Eum a et tenetur atque. Quaerat omnis sunt sapiente in id.', NULL),
(92, 'Nesciunt perspiciatis ipsum non.', 'Ea est consectetur animi culpa qui. Consequatur occaecati enim est tenetur vel. Labore ipsam nostrum dolores iste sed omnis omnis. Provident incidunt libero veritatis omnis rerum et.', NULL),
(93, 'Officiis deleniti quisquam sunt non.', 'Ut ullam necessitatibus quia consequatur magni. Aut et est voluptatem laudantium. Et et harum in quos laborum minus.', NULL),
(94, 'Modi ut sint et.', 'Vel aperiam sint enim commodi dolore. Ut neque officiis soluta possimus in. Tempore deleniti expedita delectus minus. Sed est hic rerum voluptatum. Tempora amet assumenda quia aut ratione.', NULL),
(95, 'Sit iusto veritatis qui id.', 'Commodi repellendus magnam ea nobis saepe esse. Eveniet corrupti quaerat dolorem sint. Quo architecto excepturi porro pariatur. Voluptas laboriosam sequi rerum unde totam fuga.', NULL),
(96, 'Fuga laborum dignissimos aut cumque soluta dolor.', 'Dolor sapiente dolorem ipsa ipsum excepturi. Ipsam nobis quibusdam magni illo est eius repellat. Rerum eum maiores doloribus minus nihil iusto. Deleniti ut aperiam rerum eum.', NULL),
(97, 'Deleniti dolor asperiores commodi illum.', 'Dolore dolore sed eos quia autem beatae. Quaerat est doloremque quis. Nulla qui dignissimos et error.', NULL),
(98, 'Laboriosam beatae facilis laudantium repellendus sed.', 'Et ex enim qui. Ut eos dolore nihil illo rerum exercitationem. Vel dolorem quod quis voluptatem ducimus enim. Totam earum quis sit in distinctio laboriosam.', NULL),
(99, 'Fugit perferendis explicabo dolorum odit nisi.', 'Qui eum libero nesciunt optio ut dolores. Repudiandae aut minus qui consequatur doloremque aut et. Iusto aspernatur voluptate sequi dignissimos dolorum. At quis iusto qui dolor.', NULL),
(100, 'Quod ex cumque ex quidem aut dolores autem.', 'Dolores quos adipisci repellendus tenetur. Pariatur porro modi architecto et est.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `task` varchar(191) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `completed`) VALUES
(1, 'Study some PHP', 1),
(2, 'Go to the store', 0),
(3, 'Study Python', 1),
(4, 'Go for a run', 0),
(5, 'Read a nice book', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
