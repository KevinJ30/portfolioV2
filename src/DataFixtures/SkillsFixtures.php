<?php

namespace App\DataFixtures;

use App\Entity\Skills;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $skill1 = new Skills();
        $skill1->setName('html');
        $skill1->setIcons('<svg width="106" height="96" viewBox="0 0 106 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.1696 81.603L12.8643 6H93.1358L85.8206 81.591L52.9513 90L20.1696 81.603Z" fill="#E44F26"/>
                                <path d="M53 83.574L79.5621 76.779L85.8109 12.183H53V83.574Z" fill="#F1662A"/>
                                <path d="M53 40.221H39.7027L38.7859 30.726H53V21.453H27.8034L28.044 23.943L30.5116 49.494H53V40.221Z" fill="#EBEBEB"/>
                                <path d="M53 64.302L52.9545 64.314L41.7639 61.527L41.0487 54.132H30.9603L32.368 68.688L52.9545 73.962L53 73.95V64.302Z" fill="#EBEBEB"/>
                                <path d="M52.9642 40.221V49.494H65.3382L64.1743 61.521L52.9642 64.311V73.959L73.5669 68.688L73.7165 67.122L76.0768 42.711L76.3239 40.221H52.9642Z" fill="white"/>
                                <path d="M52.9642 21.453V30.726H77.2375L77.4391 28.644L77.8975 23.943L78.1381 21.453H52.9642Z" fill="white"/>
                                </svg>');
        $skill1->setLevel(5);
        $skill1->setType('front');

        $manager->persist($skill1);

        $skill = new Skills();
        $skill->setName('css');
        $skill->setIcons('<svg width="106" height="96" viewBox="0 0 106 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.1697 81.603L12.8676 6H93.1326L85.8207 81.591L52.9513 90L20.1697 81.603Z" fill="#1572B6"/>
                                <path d="M53 83.574L79.5621 76.779L85.8109 12.183H53V83.574Z" fill="#33A9DC"/>
                                <path d="M53 39.573H66.2973L67.2141 30.078H53V20.805H78.1966L77.956 23.292L75.4884 48.846H53V39.573Z" fill="white"/>
                                <path d="M53.0618 63.654L53.0163 63.666L41.8258 60.876L41.1105 53.481H31.0221L32.4299 68.04L53.0131 73.314L53.0618 73.302V63.654Z" fill="#EBEBEB"/>
                                <path d="M65.4422 48.453L64.2328 60.87L53.026 63.66V73.308L73.6255 68.04L73.7783 66.474L75.5241 48.453H65.4422Z" fill="white"/>
                                <path d="M53.0358 20.805V30.078H28.7625L28.5609 27.993L28.1025 23.292L27.8619 20.805H53.0358Z" fill="#EBEBEB"/>
                                <path d="M53.0001 39.573V48.846H41.9493L41.7478 46.761L41.2926 42.06L41.052 39.573H53.0001Z" fill="#EBEBEB"/>
                                </svg>');
        $skill->setLevel(4);
        $skill->setType('front');
        $manager->persist($skill);
        $manager->flush();
    }
}
