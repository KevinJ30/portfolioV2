<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class NotesExtension extends AbstractExtension
{
    /**
     * Permet d'afficher la notes avec des étoiles
     *
     * @return TwigFunction[]
     **/
    public function getFunctions() : array
    {
        return [
            new TwigFunction('notes', [$this, 'generateNotesHtml'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Génére le HTML pour afficher la notes
     *
     * @param int $note Valeur de la note
     * @param bool $full Affiche toutes les êtoiles
     * @param int $maxNotes Maximum de la note
     * @return string strucure des notes
     */
    public function generateNotesHtml(int $note, bool $full = true, int $maxNotes = 5) : string
    {
        $stars = '';

        for($i = 0; $i < $maxNotes; $i++) {
            if($i < $note) {
                $stars .= $this->stars('active');
            }
            else {
                $stars .= $this->stars();
            }
        }

        return $stars;
    }

    private function stars(string $classname = '') : string {
        return '<span class="icon icon-stars ' . $classname . '"><svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.51503 19.3038C4.03253 19.5513 3.48503 19.1175 3.58253 18.5638L4.62003 12.6513L0.216276 8.45626C-0.194974 8.06376 0.0187758 7.34626 0.570026 7.26876L6.69253 6.39876L9.42253 0.990015C9.66878 0.502515 10.335 0.502515 10.5813 0.990015L13.3113 6.39876L19.4338 7.26876C19.985 7.34626 20.1988 8.06376 19.7863 8.45626L15.3838 12.6513L16.4213 18.5638C16.5188 19.1175 15.9713 19.5513 15.4888 19.3038L10 16.4838L4.51378 19.3038H4.51503Z" fill="currentColor"/>
                </svg></span>';
    }
}
