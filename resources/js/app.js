import Alpine from 'alpinejs';
import {Alg} from "cubing/alg";
import {TwistyPlayer} from "cubing/twisty";
import {randomScrambleForEvent} from "cubing/scramble";

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('moveset-form');
    const input = document.getElementById('algorithm');
    const errorMessage = document.getElementById('error-message');

    if (form && input) {
        function isValidWCA(alg) {
            const regex = /^([UDFBRLMESxyz]w?['2]?)( [UDFBRLMESxyz]w?['2]?)*$/i;

            // Also handle empty strings if you want to allow them
            if (alg.trim() === "") return true;

            return regex.test(alg.trim());
        }

        form.addEventListener('submit', (event) => {
            if (!isValidWCA(input.value)) {
                event.preventDefault();
                input.classList.add('border-red-500');
                if (errorMessage) errorMessage.classList.remove('hidden');
            } else {
                input.classList.remove('border-red-500');
                if (errorMessage) errorMessage.classList.add('hidden');
            }
        });

        input.addEventListener('input', () => {
            input.classList.remove('border-red-500');
            if (errorMessage) errorMessage.classList.add('hidden');
        });
    }


    const scrambleDisplay = document.getElementById("scramble-display");
    const timerDisplay = document.getElementById("timer-display");
    const saveBtn = document.getElementById("save-btn");

    if (scrambleDisplay && timerDisplay) {


        let currentScramble = "";
        let startTime, timerInterval;
        let isRunning = false;
        let isSpacebarDown = false;
        let finalTimeMs = 0;


        async function loadScramble() {
            try {
                scrambleDisplay.innerText = "Generating scramble...";
                const scrambleObj = await randomScrambleForEvent("333");
                currentScramble = scrambleObj.toString();
                scrambleDisplay.innerText = currentScramble;
            } catch (error) {
                console.error("Error loading scramble:", error);
                scrambleDisplay.innerText = "Error loading scramble.";
            }
        }


        loadScramble();

        function updateDisplay(ms) {
            timerDisplay.innerText = (ms / 1000).toFixed(2);
        }


        document.addEventListener("keydown", (e) => {
            if (e.code === "Space") {

                e.preventDefault();

                if (isRunning) {
                    clearInterval(timerInterval);
                    isRunning = false;
                    finalTimeMs = Date.now() - startTime;
                    updateDisplay(finalTimeMs);
                    if (saveBtn) saveBtn.classList.remove('hidden');
                } else if (!isSpacebarDown && (!saveBtn || saveBtn.classList.contains('hidden'))) {
                    isSpacebarDown = true;
                    timerDisplay.classList.add("text-[#F4C430]");

                    updateDisplay(0);
                }
            } else if (isRunning) {
                clearInterval(timerInterval);
                isRunning = false;
                finalTimeMs = Date.now() - startTime;
                updateDisplay(finalTimeMs);
                if (saveBtn) saveBtn.classList.remove('hidden');
            }
        });

        document.addEventListener("keyup", (e) => {
            if (e.code === "Space" && isSpacebarDown && !isRunning) {
                isSpacebarDown = false;
                timerDisplay.classList.remove("text-[#F4C430]");

                isRunning = true;
                startTime = Date.now();

                timerInterval = setInterval(() => {
                    updateDisplay(Date.now() - startTime);
                }, 10);
            }
        });


        const saveStatus = document.getElementById("save-status");
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (saveBtn) {
            saveBtn.addEventListener("click", async () => {
                saveBtn.classList.add('hidden');

                try {
                    const response = await fetch('/solves', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            scramble: currentScramble, // Nu kent hij deze!
                            time_ms: finalTimeMs       // Nu kent hij deze ook!
                        })
                    });

                    if (response.ok) {
                        if (saveStatus) {
                            saveStatus.innerText = "Solve saved!";
                            saveStatus.classList.remove('hidden');
                            setTimeout(() => {
                                saveStatus.classList.add('hidden');
                            }, 2000);
                        }
                        loadScramble();
                    } else {
                        console.error("Server error", await response.text());
                        alert("Error saving solve. Are you logged in?");
                        saveBtn.classList.remove('hidden');
                    }
                } catch (error) {
                    console.error("Fetch Error:", error);
                    alert("Something went wrong.");
                    saveBtn.classList.remove('hidden');
                }
            });
        }
    }
    const player = document.getElementById('player');
    const playButton = document.getElementById('play-btn');

    if (player && playButton) {
        playButton.addEventListener('click', () => {
            player.play();
        });
    }
});





