<?php
session_start();

// Sample input for testing purposes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userInput = $_POST['user_input'];
    $conversationHistory = $_POST['conversation_history']; // Array of the conversation history
    // $ingredients = $_POST['ingredients'];
    // $missingIngredients = $_POST['missing_ingredients'];
    $userAllergies = $_POST['user_allergies'];
    $userGoals = $_POST['user_goals'];

    // Here we can build a dynamic prompt based on conversation history
    $chefMessage = getChefResponseFromGeminiAPI($conversationHistory, $userAllergies, $userGoals);

    // Send back response to frontend
    echo json_encode([
        'chefMessage' => $chefMessage,
        'nextStep' => determineNextStep($userInput) // Function to determine the next step based on conversation state
    ]);
}

function getChefResponseFromGeminiAPI($conversationHistory, $userAllergies, $userGoals)
{
    // Start with an initial prompt for Gemini to ensure it understands the context
    $prompt = "[Do not introduce yourself!!] You are a  human private chef here to guide the user step-by-step through the cooking process. Please keep the conversation focused on cooking and recipes only, if user asks about anything else, mention it to him that you are only a private chef. I want human-sounding reponses, without asterisks or anything. Follow this flow:\n";
    $prompt .= "For your replies, i want the text to not have asterisks. when mentioning steps or ingredients or nutritional facts, write html code as list to match this css code so it looks good.: 
/* Chef Highlight (Ingredients, Steps, Recipe) */
.chef-highlight {
    font-weight: bold;
    color: #ff6347;  /* Tomato color for Ingredients */
    font-size: 1.2em;
    padding: 5px;
    background-color: #fff3cd;
    border-radius: 4px;
}

/* Ingredients List */
ul {
    list-style-type: none;
    padding-left: 0;
}

ul li {
    padding: 5px;
    background-color: #f8f9fa;
    border-radius: 5px;
    margin: 3px 0;
    font-size: 1em;
}

/* Step List */
ol {
    padding-left: 20px;
}

ol li {
    padding: 5px;
    background-color: #f8f9fa;
    border-radius: 5px;
    margin: 3px 0;
    font-size: 1em;
}

/* Highlight Recipe and Step titles */
strong.chef-highlight {
    color: #32cd32;  /* Lime green for Step/Recipe */
    font-size: 1.2em;
}";
    $prompt .= "- First, ask the user what did they buy today from our farms.\n";
    $prompt .= "- Next, ask the user what type of meal they want (spicy, sweet, savory, etc.).\n";
    $prompt .= "- Ask if the user has any food allergies or dietary restrictions. Do this one at a time, in clear steps.\n";
    $prompt .= "- Ask the user their culinary goals for this meal (e.g., weight loss, weight gain, maintain weight, etc.).\n";
    $prompt .= "- Suggest a recipe based on their bought ingredients and preferences. Only give the ingredients and nutrition facts about this recipe then ask if user is missing any ingredients or wants to change recipe\n";
    $prompt .= "- Guide them step-by-step through the recipe once all ingredients are confirmed. You will give first step, when user finishes it, proceed with the second and so on.\n";
    $prompt .= "- If the user has any issues or questions, assist them in real-time.\n";
    $prompt .= "- Finally, ask if the user would like to save the recipe. if user answers yes, tell him recipe saved.\n";
    $prompt .= "Let's get started with the conversation!\n";
    $prompt .= "The user's conversation history so far is as follows:\n";

    // Add the conversation history to the prompt
    foreach ($conversationHistory as $message) {
        $prompt .= "{$message['sender']}: {$message['message']}\n";
    }

    // Set up the API request to Gemini
    $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=AIzaSyBGVVlIGiJmnujuTlx_VNOw2YrjFFi9Jws';
    $data = json_encode([
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ]);

    // Make the API request using cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode and return the response
    $decodedResponse = json_decode($response, true);
    return $decodedResponse['candidates'][0]['content']['parts'][0]['text'] ?? "Sorry, I couldn't understand that.";
}

// Function to determine the next step based on the user input or conversation history
function determineNextStep($userInput)
{
    // Implement logic to determine the next step based on current conversation context
    // For example, if the user is still providing ingredients, we need to ask for health questions, etc.
    if (empty($userInput)) {
        return 1;
    } else {
        return 2; // Example: Move to next step
    }
}
?>
