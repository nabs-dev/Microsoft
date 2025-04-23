<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voice Copilot - Predefined AI Questions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #eef2f7, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 900px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            color: #0078D4;
            font-size: 36px;
            margin-bottom: 30px;
        }
        #question {
            width: 100%;
            max-width: 400px;
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 12px;
            border: 1px solid #ddd;
            font-size: 18px;
            background-color: #f4f8fc;
            color: #333;
            text-align: center;
        }
        button {
            padding: 12px 20px;
            border: none;
            background-color: #0078D4;
            color: white;
            font-size: 18px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            width: 250px;
        }
        button:hover {
            background-color: #005ea2;
        }
        #answer {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
            background: #f4f8fc;
            padding: 20px;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        .questions-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 30px;
            width: 100%;
            max-width: 800px;
        }
        .questions-list button {
            padding: 14px;
            border: 1px solid #0078D4;
            border-radius: 10px;
            background-color: white;
            text-align: left;
            font-size: 16px;
            color: #0078D4;
            transition: background-color 0.3s, color 0.3s;
        }
        .questions-list button:hover {
            background-color: #eef2f7;
            color: #005ea2;
        }
        @media (max-width: 600px) {
            .questions-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🎙️ AI Voice Copilot</h1>
    <input type="text" id="question" placeholder="Your question will appear here..." readonly />
    <button onclick="startListening()">🎤 Speak</button>

    <div id="answer"></div>

    <div class="questions-list">
        <button onclick="answerQuestion('Can AI ever truly become conscious or self-aware?')">1. Can AI ever truly become conscious or self-aware?</button>
        <button onclick="answerQuestion('How does generative AI like ChatGPT actually work?')">2. How does generative AI like ChatGPT actually work?</button>
        <button onclick="answerQuestion('What are the ethical risks of AI decision-making in law enforcement?')">3. What are the ethical risks of AI decision-making in law enforcement?</button>
        <button onclick="answerQuestion('Could AI ever replace human creativity in art or music?')">4. Could AI ever replace human creativity in art or music?</button>
        <button onclick="answerQuestion('How can we ensure AI systems are free from bias?')">5. How can we ensure AI systems are free from bias?</button>
        <button onclick="answerQuestion('What’s the difference between machine learning and deep learning?')">6. What’s the difference between machine learning and deep learning?</button>
        <button onclick="answerQuestion('Should AI be granted legal rights or responsibilities?')">7. Should AI be granted legal rights or responsibilities?</button>
        <button onclick="answerQuestion('How is AI transforming the healthcare industry?')">8. How is AI transforming the healthcare industry?</button>
        <button onclick="answerQuestion('Can AI predict human behavior accurately?')">9. Can AI predict human behavior accurately?</button>
        <button onclick="answerQuestion('What are the dangers of deepfake technology powered by AI?')">10. What are the dangers of deepfake technology powered by AI?</button>
        <button onclick="answerQuestion('How is AI being used in climate change research?')">11. How is AI being used in climate change research?</button>
        <button onclick="answerQuestion('Could AI surpass human intelligence (AGI), and what would that mean?')">12. Could AI surpass human intelligence (AGI), and what would that mean?</button>
        <button onclick="answerQuestion('What jobs are most and least vulnerable to AI automation?')">13. What jobs are most and least vulnerable to AI automation?</button>
        <button onclick="answerQuestion('How do AI algorithms learn from data, and how much data is enough?')">14. How do AI algorithms learn from data, and how much data is enough?</button>
        <button onclick="answerQuestion('Is it possible to create emotionally intelligent AI?')">15. Is it possible to create emotionally intelligent AI?</button>
        <button onclick="answerQuestion('How can AI be used responsibly in education?')">16. How can AI be used responsibly in education?</button>
        <button onclick="answerQuestion('What’s the role of AI in cybersecurity?')">17. What’s the role of AI in cybersecurity?</button>
        <button onclick="answerQuestion('Can AI help us understand complex scientific problems faster?')">18. Can AI help us understand complex scientific problems faster?</button>
        <button onclick="answerQuestion('Should there be a global governing body for AI development?')">19. Should there be a global governing body for AI development?</button>
        <button onclick="answerQuestion('What are the most exciting AI innovations happening right now?')">20. What are the most exciting AI innovations happening right now?</button>
    </div>
</div>

<script>
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    const synth = window.speechSynthesis;

    function startListening() {
        recognition.lang = 'en-US';
        recognition.start();
    }

    recognition.onresult = function(event) {
        const transcript = event.results[0][0].transcript;
        document.getElementById('question').value = transcript;
        simulateAI(transcript);
    };

    function answerQuestion(question) {
        document.getElementById('question').value = question;
        simulateAI(question);
    }

    function simulateAI(input) {
        let response = "";

        switch(input.toLowerCase()) {
            case 'can ai ever truly become conscious or self-aware?':
                response = "Currently, AI systems lack true consciousness. They can simulate behaviors but are not self-aware.";
                break;
            case 'how does generative ai like chatgpt actually work?':
                response = "Generative AI like ChatGPT works by analyzing vast amounts of text data and using machine learning algorithms to predict and generate human-like text.";
                break;
            case 'what are the ethical risks of ai decision-making in law enforcement?':
                response = "AI decision-making in law enforcement could lead to biased decisions, lack of accountability, and possible violation of human rights.";
                break;
            case 'could ai ever replace human creativity in art or music?':
                response = "AI can assist in creating art or music, but human creativity and emotional depth cannot be fully replicated by machines.";
                break;
            case 'how can we ensure ai systems are free from bias?':
                response = "By using diverse training data, constant monitoring, and creating transparent AI systems, we can reduce bias in AI models.";
                break;
            case 'what’s the difference between machine learning and deep learning?':
                response = "Machine learning involves training algorithms on data, while deep learning is a subset of machine learning that uses neural networks with many layers to process data.";
                break;
            case 'should ai be granted legal rights or responsibilities?':
                response = "AI is a tool, not a legal entity. Granting legal rights to AI could complicate accountability and decision-making.";
                break;
            case 'how is ai transforming the healthcare industry?':
                response = "AI is improving diagnostics, personalized medicine, and efficiency in healthcare, while enabling researchers to analyze vast datasets quickly.";
                break;
            case 'can ai predict human behavior accurately?':
                response = "AI can predict human behavior with a reasonable degree of accuracy, but it is not perfect due to the complexity of human nature.";
                break;
            case 'what are the dangers of deepfake technology powered by ai?':
                response = "Deepfake technology can be used to create misleading or harmful media, leading to misinformation, defamation, and security risks.";
                break;
            case 'how is ai being used in climate change research?':
                response = "AI helps in climate modeling, analyzing environmental data, and developing sustainable solutions to mitigate climate change.";
                break;
            case 'could ai surpass human intelligence (agi), and what would that mean?':
                response = "Artificial General Intelligence (AGI) could potentially surpass human intelligence, leading to drastic changes in society and the economy.";
                break;
            case 'what jobs are most and least vulnerable to ai automation?':
                response = "Jobs involving repetitive tasks are most vulnerable to AI automation, while jobs requiring human empathy and creativity are least vulnerable.";
                break;
            case 'how do ai algorithms learn from data, and how much data is enough?':
                response = "AI algorithms learn from large datasets, and the quality and quantity of data directly affect the performance of the model.";
                break;
            case 'is it possible to create emotionally intelligent ai?':
                response = "Creating emotionally intelligent AI is possible to an extent, but true emotional intelligence involves understanding and feeling emotions, which AI lacks.";
                break;
            case 'how can ai be used responsibly in education?':
                response = "AI can be used responsibly in education by personalizing learning, providing real-time feedback, and ensuring ethical use in classrooms.";
                break;
            case 'what’s the role of ai in cybersecurity?':
                response = "AI helps in detecting and responding to cyber threats, improving security systems through automated analysis of vulnerabilities and attacks.";
                break;
            case 'can ai help us understand complex scientific problems faster?':
                response = "AI can speed up scientific discoveries by processing complex data and simulating experiments that would take much longer manually.";
                break;
            case 'should there be a global governing body for ai development?':
                response = "A global governing body could help establish guidelines and standards for AI development, ensuring safety and ethics.";
                break;
            case 'what are the most exciting ai innovations happening right now?':
                response = "Exciting AI innovations include advancements in healthcare diagnostics, autonomous vehicles, and natural language processing like GPT models.";
                break;
            default:
                response = "Sorry, I don't have an answer for that yet!";
        }

        document.getElementById('answer').innerText = "🧠 AI
