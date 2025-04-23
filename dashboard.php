<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Microsoft Copilot Dashboard</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { display: flex; font-family: 'Segoe UI', sans-serif; height: 100vh; background: #f4f7fa; }

    .sidebar {
      width: 250px;
      background: #0078d4;
      color: white;
      padding: 30px 20px;
      height: 100vh;
      position: fixed;
    }
    .sidebar h2 {
      margin-bottom: 30px;
      font-size: 24px;
    }
    .sidebar ul {
      list-style: none;
    }
    .sidebar ul li {
      margin-bottom: 20px;
      font-size: 18px;
      cursor: pointer;
    }
    .sidebar ul li:hover {
      color: #cce7ff;
    }

    .main {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 20px;
    }
    .section {
      display: none;
    }
    .section.active {
      display: block;
    }

    h1 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #0078d4;
    }

    .task-btn {
      background: #0078d4;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-bottom: 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .task-input {
      margin-bottom: 20px;
    }
    .task-input input {
      padding: 10px;
      width: 60%;
      margin-right: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .task-list {
      list-style: none;
    }
    .task-list li {
      background: #fff;
      margin-bottom: 10px;
      padding: 10px;
      border-left: 5px solid #0078d4;
      border-radius: 5px;
    }

    .questions button {
      display: block;
      width: 100%;
      text-align: left;
      padding: 12px;
      margin: 5px 0;
      border-radius: 6px;
      border: 1px solid #0078d4;
      background: #fff;
      cursor: pointer;
      font-size: 16px;
      color: #0078d4;
      transition: 0.3s;
    }

    .questions button:hover {
      background: #eef6fc;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>AI Copilot</h2>
    <ul>
      <li onclick="switchSection('dashboard')">Dashboard</li>
      <li onclick="switchSection('tasks')">Tasks</li>
      <li onclick="switchSection('questions')">AI Questions</li>
      <li onclick="window.location.href='logout.php'">Logout</li>
    </ul>
  </div>

  <div class="main">
    <div id="dashboard" class="section active">
      <h1>Welcome, <?= $_SESSION['user'] ?> 👋</h1>
      <p>This is your Microsoft Copilot inspired workspace. Use the sidebar to navigate.</p>
    </div>

    <div id="tasks" class="section">
      <h1>Task Manager</h1>
      <div class="task-input">
        <input type="text" id="taskText" placeholder="Enter your task...">
        <button class="task-btn" onclick="addTask()">Add Task</button>
      </div>
      <ul class="task-list" id="taskList"></ul>
    </div>

    <div id="questions" class="section">
      <h1>Predefined AI Questions</h1>
      <div class="questions">
        <button onclick="speak(1)">1. Can AI ever truly become conscious or self-aware?</button>
        <button onclick="speak(2)">2. How does generative AI like ChatGPT actually work?</button>
        <button onclick="speak(3)">3. What are the ethical risks of AI decision-making in law enforcement?</button>
        <button onclick="speak(4)">4. Could AI ever replace human creativity in art or music?</button>
        <button onclick="speak(5)">5. How can we ensure AI systems are free from bias?</button>
        <button onclick="speak(6)">6. What’s the difference between machine learning and deep learning?</button>
        <button onclick="speak(7)">7. Should AI be granted legal rights or responsibilities?</button>
        <button onclick="speak(8)">8. How is AI transforming the healthcare industry?</button>
        <button onclick="speak(9)">9. Can AI predict human behavior accurately?</button>
        <button onclick="speak(10)">10. What are the dangers of deepfake technology powered by AI?</button>
        <button onclick="speak(11)">11. How is AI being used in climate change research?</button>
        <button onclick="speak(12)">12. Could AI surpass human intelligence (AGI), and what would that mean?</button>
        <button onclick="speak(13)">13. What jobs are most and least vulnerable to AI automation?</button>
        <button onclick="speak(14)">14. How do AI algorithms learn from data, and how much data is enough?</button>
        <button onclick="speak(15)">15. Is it possible to create emotionally intelligent AI?</button>
        <button onclick="speak(16)">16. How can AI be used responsibly in education?</button>
        <button onclick="speak(17)">17. What’s the role of AI in cybersecurity?</button>
        <button onclick="speak(18)">18. Can AI help us understand complex scientific problems faster?</button>
        <button onclick="speak(19)">19. Should there be a global governing body for AI development?</button>
        <button onclick="speak(20)">20. What are the most exciting AI innovations happening right now?</button>
      </div>
    </div>
  </div>

  <script>
    let taskList = [];

    function switchSection(id) {
      const sections = document.querySelectorAll('.section');
      sections.forEach(sec => sec.classList.remove('active'));
      document.getElementById(id).classList.add('active');
    }

    function addTask() {
      const task = document.getElementById('taskText').value;
      if (task) {
        taskList.push(task);
        renderTasks();
        document.getElementById('taskText').value = '';
      }
    }

    function renderTasks() {
      const list = document.getElementById('taskList');
      list.innerHTML = '';
      taskList.forEach((task, index) => {
        list.innerHTML += `<li>${index + 1}. ${task}</li>`;
      });
    }

    const responses = {
      1: "AI is not conscious. It processes data but lacks self-awareness or subjective experiences.",
      2: "Generative AI like ChatGPT uses deep learning to predict and generate human-like text based on patterns.",
      3: "AI in law enforcement may reinforce bias and lack accountability if not carefully managed.",
      4: "AI can assist creativity, but it lacks the emotion and intuition of human artists.",
      5: "To reduce bias, AI must be trained on diverse, representative data and regularly audited.",
      6: "Machine learning is broad. Deep learning is a subset using neural networks for complex patterns.",
      7: "Granting AI rights is controversial since they lack consciousness or responsibilities.",
      8: "AI is revolutionizing healthcare through diagnosis, treatment planning, and predictive analytics.",
      9: "AI can detect behavioral patterns but struggles with nuance and unpredictability of humans.",
      10: "Deepfakes can mislead, damage reputations, and spread misinformation.",
      11: "AI models climate patterns, predicts events, and optimizes environmental strategies.",
      12: "AGI could exceed human intelligence, posing ethical and control challenges.",
      13: "Repetitive jobs are most vulnerable. Creative and empathetic roles are less so.",
      14: "AI learns from large labeled datasets. Quality and quantity both matter.",
      15: "AI can simulate emotion, but it doesn’t feel. Emotional intelligence is still human.",
      16: "AI can personalize learning, automate grading, and support special needs students.",
      17: "AI detects threats, identifies vulnerabilities, and strengthens digital security.",
      18: "AI accelerates discovery by modeling data faster than traditional methods.",
      19: "A global AI body could ensure ethics, fairness, and transparency.",
      20: "AI is advancing in robotics, medicine, language, and quantum computing."
    };

    function speak(id) {
      const msg = new SpeechSynthesisUtterance(responses[id] || "I don't know the answer to that.");
      msg.lang = 'en-US';
      msg.rate = 1;
      msg.pitch = 1;
      window.speechSynthesis.speak(msg);
    }
  </script>
</body>
</html>
