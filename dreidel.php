<?php
    header("content-type: text/xml");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    /* This game was written in 2011 by Joshua Leavitt of San Francisco, CA as part of an (ultimately unsuccessful) application for a job at Twilio. */
    /* If you'd like to learn more about Josh, or see what he does when he isn't experimenting with PHP and TwiML, check out http://www.joshl.is */
    /* Feel free to play with the code, but please don't use my voice recordings. */
    /* I'd really prefer to not have my voice re-cut so I'm saying something else entirely, especially lewd things. */
    /* I like to say my own lewd things, thankyouverymuch, and I don't need your 'help' in saying them. */
    /* And besides, take it from me, getting the code working is exciting and whatnot, but the real fun comes from writing your own lines for the gameplay events and recording them in your most over the top Jewish parody voice. */
    /* To play the game against me, you can call this game and see how it plays from the caller's perspective by dialing 831-621-JEWS. */
    $caller_gelt = 3; /* sets the caller's starting pot at 3 */
    $my_gelt = 3; /* sets my starting pot at 3 */
?>
<Response>
    <Play>intro.aiff</Play>
    <?php
        for ($win_game = 0; $win_game == 0;) { /* defines the game as yet to be won */
            echo '<Play>ante.aiff</Play>';
            $caller_gelt--;
            $my_gelt--;
            $the_pot = 2; /* this antes for each player */
            if ($caller_gelt < 0) { /* this checks if the ante pushed the caller into the red */
                $no_debt = 1; /* triggering the statement that debt isn't tolerated */
                $win_game = 2; /* and declaring me the winner of the game */
                break 1;
            } if ($my_gelt < 0) { /* this checks if the ante pushed me into the red */
                $no_debt = 1; /* triggering the statement that debt isn't tolerated */
                $win_game = 1; /* and declaring the caller the winner of the game */
                break 1;
            }
            for ($win_round = 0; $win_round == 0;) { /* defines the round as yet to be won */
                echo '<Play>youhave.aiff</Play>';
                print "<Say>$caller_gelt</Say>";
                echo '<Play>ihave.aiff</Play>';
                print "<Say>$my_gelt</Say>";
                echo '<Play>andthereare.aiff</Play>';
                print "<Say>$the_pot</Say>";
                echo '<Play>inthepot.aiff</Play>';
                $caller_spin = rand(1, 4); /* this spins the dreidel for the caller */
                $caller_say = rand(1, 2); /* this chooses which of the two spin statements they hear */
                if ($caller_spin == 1) { /* this is if the caller spins a nun */
                    if ($caller_say == 1) {
                        echo '<Play>callernun1.aiff</Play>';
                    } elseif ($caller_say == 2) {
                        echo '<Play>callernun2.aiff</Play>';
                    } /* from here it should go directly to my turn */
                } elseif ($caller_spin == 2) { /* this is if the caller spins a hay */
                    if ($caller_say == 1) {
                        echo '<Play>callerhay1.aiff</Play>';
                    } elseif ($caller_say == 2) {
                        echo '<Play>callerhay2.aiff</Play>';
                    }
                    $hay_pot = $the_pot % 2;
                    if ($hay_pot == 0) { /* this is if the gelt in the pot is an even number */
                        $hay_take = $the_pot / 2; /* this determines the take */
                        $caller_gelt += $hay_take; /* giving it to the caller */
                        $the_pot -= $hay_take; /* and removing it from the pot */
                    } else { /* this is if the gelt in the pot is an odd number */
                        $round_pot = $the_pot - 1; /* this rounds the pot down to an even number */
                        $hay_take = $round_pot / 2; /* allowing this to determine the take */
                        $caller_gelt += $hay_take; /* giving it to the caller */
                        $the_pot -= $hay_take; /* and removing it from the pot */
                    } /* from here it should go directly to my turn */
                } elseif ($caller_spin == 3) { /*this is if the caller spins a shin */
                    if ($caller_say == 1) {
                        echo '<Play>callershin1.aiff</Play>';
                    } elseif ($caller_say == 2) {
                        echo '<Play>callershin2.aiff</Play>';
                    }
                    $caller_gelt--; /* this takes a gelt from the caller */
                    $the_pot++; /* and puts it in the pot */
                    if ($caller_gelt < 0) { /* this checks if putting one in the pot pushed the caller into the red */
                        $no_debt++; /* triggering the statement that debt isn't tolerated */
                        $win_round++; /* declaring the round over */
                        $win_game = 2; /* and declaring me the winner of the game */
                        break 2;
                    } /* from here it should go directly to my turn unless the game has been won */
                } elseif ($caller_spin == 4) { /* this is if the caller spins a gimmel */
                    if ($caller_say == 1) {
                        echo '<Play>callergimmel1.aiff</Play>';
                    } elseif ($caller_say == 2) {
                        echo '<Play>callergimmel2.aiff</Play>';
                    }
                    $caller_gelt += $the_pot; /* this gives the contents of the pot to the caller */
                    $win_round++; /* and declares the round won */
                    break 1;
                }
                $my_spin = rand(1, 4); /* this spins the dreidel for me */ 
                $my_say = rand(1, 2); /* this chooses which of the two spin statements they hear */
                if ($my_spin == 1) { /* this is if I spin a nun */
                    if ($my_say == 1) {
                        echo '<Play>mynun1.aiff</Play>';
                    } elseif ($my_say == 2) {
                        echo '<Play>mynun2.aiff</Play>';
                    }  /* from here it should go directly back to the caller's turn */
                } elseif ($my_spin == 2) { /* this is if I spin a hay */
                    if ($my_say == 1) {
                        echo '<Play>myhay1.aiff</Play>';
                    } elseif ($my_say == 2) {
                        echo '<Play>myhay2.aiff</Play>';
                    }
                    $hay_pot = $the_pot % 2;
                    if ($hay_pot == 0) { /* this is if the gelt in the pot is an even number */
                        $hay_take = $the_pot / 2; /* this determines the take */
                        $my_gelt += $hay_take; /* giving it to me */
                        $the_pot -= $hay_take; /* and removing it from the pot */
                    } else { /* this is if the gelt in the pot is an odd number */
                        $round_pot = $the_pot - 1; /* this rounds the pot down to an even number */
                        $hay_take = $round_pot / 2; /* allowing this to determine the take */
                        $my_gelt += $hay_take; /* giving it to me */
                        $the_pot -= $hay_take; /* and removing it from the pot */
                    } /* from here it should go directly back to the caller's turn */
                } elseif ($my_spin == 3) { /*this is if I spin a shin */
                    if ($my_say == 1) {
                        echo '<Play>myshin1.aiff</Play>';
                    } elseif ($my_say == 2) {
                        echo '<Play>myshin2.aiff</Play>';
                    }
                    $my_gelt--; /* this takes a gelt from me */
                    $the_pot++; /* and puts it in the pot */
                    if ($my_gelt < 0) { /* this checks if putting one in the pot pushed me into the red */
                        $no_debt++; /* triggering the statement that debt isn't tolerated */
                        $win_round++; /* declaring the round over */
                        $win_game = 1; /* and declaring the caller the winner of the game */
                        break 2;
                    } /* from here it should go directly back to the caller's turn unless the game has been won */
                } elseif ($my_spin == 4) { /* this is if I spin a gimmel */
                    if ($my_say == 1) {
                        echo '<Play>mygimmel1.aiff</Play>';
                    } elseif ($my_say == 2) {
                        echo '<Play>mygimmel2.aiff</Play>';
                    }
                    $my_gelt += $the_pot; /* this gives the contents of the pot to me */
                    $win_round++; /* and declares the round won */
                    break 1;
                }
            }
        }
        if ($no_debt > 0) { /* this is triggered if the game ended by someone going into debt */
            echo '<Play>nodebt.aiff</Play>';
        }
        $win_say = rand(1, 2); /* this randomly selects which of the two win statements are to be read */
        if ($win_game == 1) { /* this is if the caller won */
            if ($win_say == 1) {
                echo '<Play>callerwin1.aiff</Play>';
            } elseif ($win_say == 2) {
                echo '<Play>callerwin2.aiff</Play>';
            }
            echo '<Sms to="+14154885250">You lost at dreidel.</Sms>'; /* this sends me a text so I know I lost the game */
        } elseif ($win_game == 2) { /* this is if I won */
            if ($win_say == 1) {
                echo '<Play>mywin1.aiff</Play>';
            } elseif ($win_say == 2) {
                echo '<Play>mywin2.aiff</Play>';
            }
            echo '<Sms to="+14154885250">You won at dreidel.</Sms>'; /* this sends me a text so I know I lost the game */
        }
    ?>
    <Play>outro.aiff</Play>
    <Hangup />
</Response>