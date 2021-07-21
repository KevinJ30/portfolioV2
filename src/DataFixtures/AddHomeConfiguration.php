<?php

namespace App\DataFixtures;

use App\Entity\Configuration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddHomeConfiguration extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $configuration = new Configuration();
        $configuration->setName('site_title')->setContent('Développeur full Stack');

        $manager->persist($configuration);

        $configuration = new Configuration();
        $configuration->setName('introduction')
                      ->setContent('Passionné par la création digitale depuis plus de dix ans, j’ai aujourd’hui acquis les compétences d’un développeur fullstack junior. Pendant toutes ces années je me suis auto-former en commençant par apprendre les langages de bases qui sont le HTML, CSS, JAVASCRIPT et j’ai continué par l’apprentissage du PHP.
        Lors de mon apprentissage, j’ai pu décrocher une première expérience avec une association sportive, pour laquelle j’ai réalisé un site web avec wordpress, des modules personnaliser et un thème personnalisé.
        Voulant mettre à profit mes compétences, j’ai effectué une formation de développeur d’application frontend diplômante, qui est équivalente à une License. Ceci m’a permis de renforcer mes compétences acquises.
        Je suis quelqu’un de nature organisé et ayant une grande curiosité qui pourrait être un atout pour vous.
        Si mon profil vous intéresse, n’hésitez pas à me contacter.');
        $manager->persist($configuration);

        $configuration = new Configuration();
        $configuration->setName('svg_introduction')
                      ->setContent('<svg viewBox="0 0 551 346" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M48.3587 12C48.3587 5.37259 53.7313 0 60.3587 0H504.938C511.565 0 516.938 5.37258 516.938 12V314.004C516.938 320.632 511.565 326.004 504.938 326.004H60.3587C53.7312 326.004 48.3587 320.632 48.3587 314.004V244.503V163.002V12Z" fill="#121617"/>
<path d="M0 320.165C0 317.404 2.23858 315.165 5 315.165H545.288C548.05 315.165 550.288 317.404 550.288 320.165V331.753C550.288 332.362 550.179 332.965 549.94 333.525C549.338 334.933 548.025 337.752 546.536 339.344C542.964 343.167 534.408 344.183 532.982 344.328C532.844 344.342 532.706 344.347 532.566 344.347C318.237 344.348 226.444 345.178 12.5121 345.181C11.7006 345.181 10.8815 344.986 10.1787 344.58C8.63118 343.687 5.78736 341.924 4.16885 340.178C2.70178 338.596 1.23847 335.945 0.497734 334.507C0.16025 333.853 0 333.126 0 332.389V320.165Z" fill="#60676B"/>
<path d="M0 320.165C0 317.404 2.23858 315.165 5 315.165H545.288C548.05 315.165 550.288 317.404 550.288 320.165V332.674H0V320.165Z" fill="#1B1F22"/>
<path d="M64.2003 25.8417C64.2003 20.3188 68.6774 15.8416 74.2003 15.8416H491.096C496.619 15.8416 501.096 20.3188 501.096 25.8416V292.653H64.2003V25.8417Z" fill="#202528"/>
<rect x="242.627" y="321.835" width="65.8678" height="5.83639" rx="2.9182" fill="#60676B"/>
<g filter="url(#filter0_d)">
<rect x="84.2001" y="55.2043" width="157.946" height="43.7034" fill="#60676B"/>
<rect x="90.0191" y="62.6256" width="41.5646" height="4.12296" fill="#EFEFF0"/>
<rect x="90.0191" y="77.4683" width="102.249" height="4.12296" fill="#EFEFF0"/>
<rect x="90.0191" y="87.3634" width="102.249" height="4.12296" fill="#EFEFF0"/>
<rect x="90.0191" y="70.047" width="4.15646" height="4.12296" fill="#EFEFF0"/>
<rect x="97.5007" y="70.047" width="4.15646" height="4.12296" fill="#EFEFF0"/>
<rect x="104.982" y="70.047" width="4.15647" height="4.12296" fill="#EFEFF0"/>
<rect x="112.464" y="70.047" width="4.15647" height="4.12296" fill="#EFEFF0"/>
</g>
<g filter="url(#filter1_d)">
<rect x="84.2001" y="106.575" width="157.946" height="43.7034" fill="#60676B"/>
<rect x="90.0191" y="113.996" width="41.5646" height="4.12296" fill="#EFEFF0"/>
<rect x="90.0191" y="128.839" width="102.249" height="4.12296" fill="#EFEFF0"/>
<rect x="90.0191" y="138.734" width="102.249" height="4.12296" fill="#EFEFF0"/>
<rect x="90.0191" y="121.418" width="4.15646" height="4.12296" fill="#EFEFF0"/>
<rect x="97.5007" y="121.418" width="4.15646" height="4.12296" fill="#EFEFF0"/>
<rect x="104.982" y="121.418" width="4.15647" height="4.12296" fill="#EFEFF0"/>
<rect x="112.464" y="121.418" width="4.15647" height="4.12296" fill="#EFEFF0"/>
</g>
<g filter="url(#filter2_d)">
<rect x="84.2001" y="157.946" width="157.946" height="45.2368" fill="#60676B"/>
<rect x="90.0191" y="165.627" width="41.5646" height="4.26763" fill="#EFEFF0"/>
<rect x="90.0191" y="180.991" width="102.249" height="4.26763" fill="#EFEFF0"/>
<rect x="90.0191" y="191.233" width="102.249" height="4.26762" fill="#EFEFF0"/>
<rect x="90.0191" y="173.309" width="4.15646" height="4.26763" fill="#EFEFF0"/>
<rect x="97.5007" y="173.309" width="4.15646" height="4.26763" fill="#EFEFF0"/>
<rect x="104.982" y="173.309" width="4.15647" height="4.26763" fill="#EFEFF0"/>
<rect x="112.464" y="173.309" width="4.15647" height="4.26763" fill="#EFEFF0"/>
</g>
<g filter="url(#filter3_d)">
<rect x="84.2001" y="209.316" width="157.946" height="45.2368" fill="#60676B"/>
<rect x="90.0191" y="216.998" width="41.5646" height="4.26763" fill="#EFEFF0"/>
<rect x="90.0191" y="232.361" width="102.249" height="4.26763" fill="#EFEFF0"/>
<rect x="90.0191" y="242.604" width="102.249" height="4.26762" fill="#EFEFF0"/>
<rect x="90.0191" y="224.68" width="4.15646" height="4.26763" fill="#EFEFF0"/>
<rect x="97.5007" y="224.68" width="4.15646" height="4.26763" fill="#EFEFF0"/>
<rect x="104.982" y="224.68" width="4.15647" height="4.26763" fill="#EFEFF0"/>
<rect x="112.464" y="224.68" width="4.15647" height="4.26763" fill="#EFEFF0"/>
</g>
<g filter="url(#filter4_d)">
<rect x="249.813" y="55.2043" width="231.551" height="199.349" fill="#60676B"/>
</g>
<path d="M389.971 173.138H352.909L345.298 179.635L337.686 173.138H321.654V177.593C321.654 183.272 325.577 187.898 330.428 187.989C330.879 190.796 331.97 193.332 333.613 195.317C336.043 198.252 339.576 199.871 343.56 199.871H368.065C372.049 199.871 375.582 198.252 378.012 195.313C379.655 193.329 380.746 190.793 381.198 187.986C383.774 187.939 386.089 186.612 387.695 184.527C389.195 182.529 389.995 180.092 389.971 177.593V173.138Z" fill="#EFEFF0"/>
<path d="M338.176 167.197L345.292 172.431L352.471 167.197H389.971V165.712C389.969 164.001 389.377 162.343 388.295 161.017C387.213 159.691 385.707 158.779 384.031 158.435C383.878 152.923 381.617 148.31 377.438 145.068C373.573 142.054 368.409 140.464 362.496 140.464H349.129C336.465 140.464 327.886 147.662 327.595 158.435C325.919 158.779 324.412 159.691 323.33 161.017C322.248 162.343 321.656 164.001 321.654 165.712V167.197H338.176Z" fill="#EFEFF0"/>
<path d="M404.652 125.613H390.805L392.461 118.993L400.739 116.145L398.882 110.761L387.372 114.474L384.682 125.613H357.298V131.554H360.779L361.124 134.524H362.496C369.736 134.524 376.17 136.547 381.083 140.375C383.815 142.481 386.03 145.182 387.558 148.275C388.5 150.193 389.17 152.233 389.55 154.336C392.316 156.039 394.367 158.691 395.32 161.797C396.273 164.903 396.062 168.249 394.727 171.211C395.51 173.248 395.911 175.411 395.912 177.593C395.912 181.741 394.501 185.693 391.939 188.723C390.354 190.611 388.323 192.076 386.03 192.983C385.249 195.21 384.084 197.283 382.59 199.109C382.371 199.373 382.146 199.631 381.916 199.88H395.912C398.882 199.88 400.182 198.395 400.553 195.61L407.31 131.563H410.763V125.613H404.652Z" fill="#EFEFF0"/>
<defs>
<filter id="filter0_d" x="82.2001" y="55.2043" width="161.946" height="47.7034" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
<feOffset dy="2"/>
<feGaussianBlur stdDeviation="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0.0486979 0 0 0 0 0.0597396 0 0 0 0 0.0625 0 0 0 0.8 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
</filter>
<filter id="filter1_d" x="82.2001" y="106.575" width="161.946" height="47.7034" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
<feOffset dy="2"/>
<feGaussianBlur stdDeviation="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0.0486979 0 0 0 0 0.0597396 0 0 0 0 0.0625 0 0 0 0.8 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
</filter>
<filter id="filter2_d" x="82.2001" y="157.946" width="161.946" height="49.2368" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
<feOffset dy="2"/>
<feGaussianBlur stdDeviation="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0.0486979 0 0 0 0 0.0597396 0 0 0 0 0.0625 0 0 0 0.8 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
</filter>
<filter id="filter3_d" x="82.2001" y="209.316" width="161.946" height="49.2368" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
<feOffset dy="2"/>
<feGaussianBlur stdDeviation="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0.0486979 0 0 0 0 0.0597396 0 0 0 0 0.0625 0 0 0 0.8 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
</filter>
<filter id="filter4_d" x="247.813" y="55.2043" width="235.551" height="203.349" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
<feOffset dy="2"/>
<feGaussianBlur stdDeviation="1"/>
<feColorMatrix type="matrix" values="0 0 0 0 0.07 0 0 0 0 0.0805 0 0 0 0 0.0875 0 0 0 1 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
</filter>
</defs>
</svg>
');

        $manager->persist($configuration);
        $manager->flush();
    }
}
