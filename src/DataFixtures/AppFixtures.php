<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $posts = json_decode(
            '[{"title":"Est culpa culpa qui minim sint eu non et esse.","published_at":"2018-05-01 08:38:38","content":"Exercitation sint mollit enim ex laborum cillum ipsum irure dolor elit. In magna irure ut velit laboris ullamco velit sit qui fugiat duis ut excepteur. Consequat consequat commodo aliqua dolor proident tempor labore labore et anim reprehenderit. Magna incididunt cupidatat esse dolor aliqua commodo Lorem amet do reprehenderit ex. Minim labore laboris et duis enim do. Non minim anim irure minim tempor irure est elit deserunt nulla sunt minim eiusmod ut.\n\nUllamco exercitation sint in eu ipsum ad excepteur esse quis. Sint et Lorem cillum voluptate incididunt sint excepteur laboris. Mollit cupidatat consectetur ex est magna aliquip commodo ea mollit tempor in fugiat magna. Quis laborum culpa exercitation elit duis aliqua non nostrud deserunt deserunt ad occaecat deserunt occaecat. Sit cillum nostrud amet laboris. Deserunt proident dolor veniam laborum enim aliquip proident sint officia aute nostrud.\n\nExcepteur sunt proident ullamco sunt pariatur ad. Tempor id duis cillum nisi incididunt et occaecat labore exercitation veniam consectetur eiusmod anim. Pariatur velit exercitation ut in pariatur nulla nulla nulla irure sunt esse exercitation.","author":"Hogan Carrillo","slug":"est-culpa-culpa-qui-minim-sint-eu-non-et-esse"},{"title":"Laboris eu velit aliqua amet Lorem.","published_at":"2018-06-14 20:58:39","content":"Magna deserunt dolor ad nulla enim nostrud ipsum ullamco in minim irure. Lorem est dolor velit commodo id voluptate eu adipisicing est consequat sunt. Ex sint consequat dolore mollit deserunt ipsum duis quis sint ullamco officia incididunt mollit. Ipsum reprehenderit irure qui labore incididunt voluptate quis qui eu Lorem aliquip.\n\nConsequat incididunt occaecat eiusmod consectetur laboris eu. Nulla excepteur laboris cupidatat officia pariatur est amet sit enim quis occaecat enim. Quis ipsum dolore eiusmod velit Lorem.\n\nConsequat ex anim in occaecat aliqua aute sunt sint cupidatat sit. Pariatur exercitation tempor occaecat qui ut id cupidatat excepteur aliquip consectetur occaecat. Anim cillum ad eiusmod est velit irure aute. Laboris non nostrud quis excepteur dolor ipsum anim irure occaecat ipsum est nulla. Qui aute et laboris aliquip id sunt consectetur dolor ad quis.","author":"Mayra Wells","slug":"laboris-eu-velit-aliqua-amet-lorem"},{"title":"Eiusmod eu exercitation in ut exercitation voluptate amet fugiat.","published_at":"2019-03-28 00:14:30","content":"Cupidatat dolor adipisicing fugiat consequat irure. Officia nostrud proident do in. Elit nostrud consequat magna in non deserunt non sit eiusmod nulla excepteur magna tempor.\n\nCulpa laborum enim ea dolore eiusmod nisi labore dolor veniam occaecat sit eu Lorem. Laborum ullamco nulla commodo anim deserunt in enim esse adipisicing esse. Consequat id veniam cupidatat ad duis deserunt amet Lorem consectetur. Labore sunt voluptate elit id voluptate voluptate. Laborum et proident cillum velit id minim tempor eu nostrud.\n\nOccaecat anim labore in consectetur cupidatat et consectetur do ullamco commodo. Tempor sit fugiat est esse in deserunt mollit nulla eu excepteur sunt. Voluptate velit sit elit Lorem et laboris occaecat eu irure ullamco aute commodo excepteur. Deserunt dolore tempor quis dolore quis labore consectetur consequat dolor incididunt nulla culpa.","author":"Joan Summers","slug":"eiusmod-eu-exercitation-in-ut-exercitation-voluptate-amet-fugiat"},{"title":"Duis ad ipsum enim id incididunt ad quis veniam nisi eiusmod nostrud sit.","published_at":"2017-01-14 01:34:19","content":"Tempor laboris occaecat mollit sunt ad minim nisi officia incididunt laboris laborum id consectetur. Labore aliqua irure minim pariatur adipisicing aute velit sit. Commodo voluptate exercitation do ullamco amet. Ad ut quis aliqua nostrud occaecat Lorem eiusmod ea tempor cupidatat cupidatat adipisicing pariatur ullamco. Quis mollit exercitation consectetur ex consectetur. Quis tempor culpa non exercitation non ad esse duis sint.\n\nEnim voluptate proident officia ipsum dolor id reprehenderit laborum dolore ex magna est proident. Incididunt duis laboris cillum esse. Dolore culpa pariatur commodo duis fugiat ad ad cillum minim cupidatat pariatur et. Aute aliquip nisi qui anim non qui id dolor Lorem commodo excepteur in incididunt laborum. Cupidatat dolor est cillum incididunt velit. Mollit mollit commodo reprehenderit nostrud in proident non duis nisi ex et. Cillum do ullamco excepteur exercitation dolor exercitation amet labore.\n\nProident amet magna cupidatat irure ullamco sunt sunt ea sit nulla officia eiusmod. Minim ex ad consequat nisi proident eiusmod. Et reprehenderit incididunt ad cupidatat voluptate qui. Et deserunt cillum culpa proident irure commodo irure elit ea consequat deserunt nisi commodo. Cillum do do sit velit elit ea anim labore consectetur.","author":"Vonda Cummings","slug":"duis-ad-ipsum-enim-id-incididunt-ad-quis-veniam-nisi-eiusmod-nostrud-sit"},{"title":"Occaecat ad ut dolor deserunt elit velit.","published_at":"2019-03-05 10:04:58","content":"Irure et exercitation reprehenderit pariatur pariatur enim non amet id non. Sit reprehenderit in voluptate ex deserunt dolore non minim. Laboris est labore adipisicing esse do proident.\n\nNisi eiusmod dolor elit voluptate Lorem ad nostrud ad. Aliquip ad ullamco dolor anim dolor. Non cillum eu sint ad do ullamco pariatur anim. Labore irure excepteur ut aute occaecat aliqua non est consequat. Velit ea et non commodo ipsum.\n\nCillum quis ad nulla aliqua consectetur sit laboris veniam esse. Dolore excepteur commodo labore quis reprehenderit exercitation velit dolor. Exercitation veniam veniam elit tempor esse eu cupidatat sit sunt exercitation.","author":"Jones Black","slug":"occaecat-ad-ut-dolor-deserunt-elit-velit"}]',
            true
        );

        foreach ($posts as $post) {
            $blogPost = new BlogPost();
            $blogPost
                ->setTitle($post['title'])
                ->setPublishedAt(new \DateTime($post['published_at']))
                ->setContent($post['content'])
                ->setAuthor($post['author'])
                ->setSlug($post['slug'])
            ;

            $manager->persist($blogPost);
        }

        $manager->flush();
    }
}
