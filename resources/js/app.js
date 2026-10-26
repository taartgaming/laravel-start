import Alpine from 'alpinejs';
import {Alg} from "cubing/alg";
import {TwistyPlayer} from "cubing/twisty";
import {randomScrambleForEvent} from "cubing/scramble";

const form = document.getElementById('moveset-form');
const input = document.getElementById('algorithm');


window.Alpine = Alpine;

Alpine.start();


//cube validation
// This Regex strictly checks for valid WCA moves separated by spaces



