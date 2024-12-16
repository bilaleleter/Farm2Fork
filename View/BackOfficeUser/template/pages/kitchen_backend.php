<?php
session_start();
//include_once('config.php'); // Database connection
//include_once('RecipeController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = $_POST['user_input'];  // Get the user input from the frontend
    $step = isset($_POST['step']) ? $_POST['step'] : 1;  // Get the current step of the conversation
    $ingredients = isset($_POST['ingredients']) ? $_POST['ingredients'] : "";  // Ingredients array
    $missingIngredients = isset($_POST['missing_ingredients']) ? $_POST['missing_ingredients'] : "";  // Missing ingredients array
    $alergies = isset($_POST['alergies']) ? $_POST['alergies'] : ""; // Health-related preferences
    $goals = isset($_POST['goals']) ? $_POST['goals'] : ""; // Health-related preferences

    // Generate prompt dynamically based on user interaction
    $chefMessage = getChefResponseFromGeminiAPI($userMessage, $step, $ingredients, $missingIngredients, $alergies, $goals);

    // Return the chef's message and next step
    echo json_encode([
        'chefMessage' => $chefMessage,
        'nextStep' => $step < 6 ? $step+ 1 : $step 
    ]);
}

// Function to get chef's response from Gemini API
function getChefResponseFromGeminiAPI($userMessage, $step, $ingredients, $missingIngredients, $alergies, $goals)
{
    $prompt = "You are a personal chef. Guide the user through the cooking process. Only respond about food, recipes, and cooking tips. Keep the conversation friendly and helpful. Do not repeat your introduction.";

    // Generate prompt based on the current conversation step
    switch ($step) {
    case 1:
        // Step 1: User provides ingredients
        $prompt .= " The user has the following ingredients: $userMessage. Ask the user what type of meal they want (e.g., sweet, savory, spicy, etc.).";
        break;
    
    case 2:
        // Step 2: Ask about health (start with dietary restrictions)
        $prompt .= " Does the user have any food allergies or dietary restrictions (e.g., dairy, gluten, nuts)? Please ask this one question before proceeding.";
        break;

    case 3:
        // Step 3: Ask about weight goal (keep it simple)
        $prompt .= " What are your goals for this meal? Are you aiming to lose weight, gain weight, or maintain your current weight? Ask only one of these before proceeding.";
        break;
    
    case 4:
        // Step 4: Recipe suggestion
        $prompt .= " Based on the ingredients: ($ingredients) and the user's allergies and dietary restrictions: $alergies and the user health goals: $goals, suggest a recipe. Ensure that the recipe suits the user's taste and dietary preferences. Do not mention instructions. Only mention recipe name with nutrition facts and health facts aligning with user as well as ingredients. ask the user if they are missing any ingredients.";
        break;
    
    case 5:
        // Step 6: Handle missing ingredients (suggest substitutions or new recipe)
        $prompt .= " The user is missing these ingredients: $missingIngredients. Ask if they can substitute any of these, or offer to find a new recipe that works with what they have.";
        break;
    
    case 6:
        $prompt .= "based on the user info (bought ingredients: $ingredients| missing ingredients: | $missingIngredients | alergies and dietary restrictions: $alergies | health goals: $goals) reply to the user and help him find the recipe for which he has all ingredients, if he is missing any ask him again .$userMessage";
        break;
}

    // Call Gemini API
    $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=AIzaSyBGVVlIGiJmnujuTlx_VNOw2YrjFFi9Jws';
    $data = json_encode([
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ]);

    // Use cURL to send request
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    // Parse and return the response
    $decodedResponse = json_decode($response, true);
    return $decodedResponse['candidates'][0]['content']['parts'][0]['text'] ?? "Sorry, I couldn't understand that.";
}
?>