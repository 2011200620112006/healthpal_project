-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 12:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthpal`
--

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `prevention` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `name`, `description`, `symptoms`, `treatment`, `prevention`, `created_at`) VALUES
(1, 'Asthma', 'Chronic respiratory disease causing breathing difficulty.', '[\"Wheezing\",\"Shortness of breath\",\"Chest tightness\",\"Coughing\",\"Difficulty breathing\"]', '[\"Inhalers\",\"Steroid medications\",\"Anti-inflammatory drugs\",\"Allergy medications\",\"Lifestyle changes\"]', '[\"Avoid allergens\",\"Use air purifier\",\"Exercise regularly\",\"Manage stress\",\"Get flu vaccine\"]', '2026-02-16 09:15:04'),
(2, 'Diabetes', 'A metabolic disorder affecting blood sugar levels.', '[\"Increased thirst\",\"Frequent urination\",\"Extreme hunger\",\"Weight loss\",\"Fatigue\",\"Blurred vision\"]', '[\"Insulin therapy\",\"Oral medications\",\"Blood sugar monitoring\",\"Dietary changes\",\"Exercise\"]', '[\"Maintain healthy weight\",\"Balanced diet\",\"Exercise\",\"Regular check-ups\",\"Limit sugar intake\"]', '2026-02-16 09:15:04'),
(3, 'Hypertension (BP)', 'Consistently high blood pressure condition.', '[\"Headaches\",\"Shortness of breath\",\"Nosebleeds\",\"Flushing\",\"Dizziness\",\"Chest pain\"]', '[\"ACE inhibitors\",\"Beta-blockers\",\"Diuretics\",\"Calcium channel blockers\",\"Lifestyle modifications\"]', '[\"Reduce salt intake\",\"Exercise regularly\",\"Maintain weight\",\"Limit alcohol\",\"Manage stress\"]', '2026-02-16 09:15:04'),
(4, 'Migraine', 'Severe headache with nausea and sensitivity.', '[\"Throbbing headache\",\"Nausea\",\"Light sensitivity\",\"Aura\",\"Vomiting\",\"Dizziness\"]', '[\"Pain relievers\",\"Triptans\",\"Anti-nausea drugs\",\"Preventive medications\",\"Rest\"]', '[\"Identify triggers\",\"Regular sleep\",\"Stress management\",\"Stay hydrated\",\"Regular meals\"]', '2026-02-16 09:15:04'),
(5, 'COVID-19', 'Viral respiratory illness.', '[\"Fever\",\"Cough\",\"Shortness of breath\",\"Loss of taste\",\"Fatigue\",\"Body aches\"]', '[\"Antiviral medications\",\"Rest\",\"Fever reducers\",\"Oxygen therapy\",\"Hospital care\"]', '[\"Vaccination\",\"Masks\",\"Social distancing\",\"Hand hygiene\",\"Ventilation\"]', '2026-02-16 09:15:04'),
(6, 'Tuberculosis', 'Bacterial lung infection.', '[\"Persistent cough\",\"Chest pain\",\"Coughing up blood\",\"Fever\",\"Night sweats\",\"Weight loss\"]', '[\"Antibiotic therapy (6-9 months)\",\"Isoniazid\",\"Rifampin\",\"Ethambutol\",\"Pyrazinamide\"]', '[\"BCG vaccination\",\"Avoid close contact with infected\",\"Good ventilation\",\"Cover mouth when coughing\",\"Complete treatment if infected\"]', '2026-02-16 09:18:36'),
(7, 'Heart Disease', 'Conditions affecting the heart.', '[\"Chest pain\",\"Shortness of breath\",\"Palpitations\",\"Fatigue\",\"Swelling in legs\",\"Dizziness\"]', '[\"Medications\",\"Angioplasty\",\"Bypass surgery\",\"Pacemaker\",\"Lifestyle changes\",\"Cardiac rehabilitation\"]', '[\"Healthy diet\",\"Regular exercise\",\"No smoking\",\"Control blood pressure\",\"Manage stress\"]', '2026-02-16 09:18:36'),
(8, 'Stroke', 'Blood flow interruption to the brain.', '[\"Sudden numbness\",\"Confusion\",\"Trouble speaking\",\"Vision problems\",\"Dizziness\",\"Severe headache\"]', '[\"Clot-busting drugs\",\"Thrombectomy\",\"Rehabilitation therapy\",\"Blood thinners\",\"Surgery\"]', '[\"Control blood pressure\",\"Manage cholesterol\",\"No smoking\",\"Healthy diet\",\"Regular exercise\"]', '2026-02-16 09:18:36'),
(9, 'Eye Infection', 'Bacterial or viral infection in the eye.', '[\"Redness\",\"Itching\",\"Discharge\",\"Watering\",\"Sensitivity to light\",\"Blurred vision\"]', '[\"Antibiotic eye drops\",\"Antiviral medication\",\"Warm compresses\",\"Artificial tears\",\"Steroid eye drops\"]', '[\"Wash hands frequently\",\"Avoid touching eyes\",\"Clean lenses properly\",\"Avoid sharing makeup\",\"Protect eyes\"]', '2026-02-16 09:18:36'),
(10, 'Skin Rash', 'Change in skin color or appearance.', '[\"Red patches\",\"Itching\",\"Bumps\",\"Blisters\",\"Dryness\",\"Swelling\"]', '[\"Topical creams\",\"Antihistamines\",\"Moisturizers\",\"Steroid creams\",\"Avoid triggers\"]', '[\"Identify allergens\",\"Gentle skincare\",\"Moisturize\",\"Avoid irritants\",\"Sun protection\"]', '2026-02-16 09:18:36'),
(11, 'Joint Pain', 'Pain in joints such as knees or hips.', '[\"Joint pain\",\"Stiffness\",\"Swelling\",\"Warmth\",\"Reduced mobility\",\"Cracking sound\"]', '[\"Pain relievers\",\"Anti-inflammatory drugs\",\"Physical therapy\",\"Joint injections\",\"Rest\"]', '[\"Maintain weight\",\"Exercise\",\"Proper posture\",\"Strengthen muscles\",\"Avoid overuse\"]', '2026-02-16 09:18:36'),
(12, 'Muscle Pain', 'Pain in muscles from overuse.', '[\"Muscle soreness\",\"Stiffness\",\"Weakness\",\"Cramps\",\"Tenderness\",\"Limited movement\"]', '[\"Rest\",\"Ice or heat therapy\",\"Pain relievers\",\"Stretching\",\"Massage\"]', '[\"Warm up\",\"Hydration\",\"Proper technique\",\"Gradual activity increase\",\"Adequate rest\"]', '2026-02-16 09:18:36'),
(13, 'Fatigue', 'Extreme tiredness or lack of energy.', '[\"Tiredness\",\"Weakness\",\"Lack of motivation\",\"Poor concentration\",\"Headaches\",\"Irritability\"]', '[\"Lifestyle changes\",\"Sleep improvement\",\"Stress management\",\"Nutrition support\"]', '[\"Regular sleep\",\"Balanced diet\",\"Exercise\",\"Stress reduction\",\"Hydration\"]', '2026-02-16 09:18:36'),
(14, 'Insomnia', 'Difficulty falling or staying asleep.', '[\"Difficulty sleeping\",\"Frequent waking\",\"Early waking\",\"Daytime sleepiness\",\"Irritability\",\"Poor concentration\"]', '[\"Sleep therapy\",\"Sleep medications\",\"Relaxation\",\"Sleep hygiene\",\"Light therapy\"]', '[\"Consistent sleep schedule\",\"Avoid caffeine\",\"Restful environment\",\"Limit screen time\",\"Exercise\"]', '2026-02-16 09:18:36'),
(15, 'Stress', 'Mental or emotional strain.', '[\"Anxiety\",\"Irritability\",\"Headaches\",\"Muscle tension\",\"Sleep problems\",\"Fatigue\"]', '[\"Counseling or therapy\",\"Meditation\",\"Exercise\",\"Time management\",\"Medications if severe\"]', '[\"Regular exercise\",\"Healthy diet\",\"Adequate sleep\",\"Time management\",\"Social support\"]', '2026-02-16 09:20:25'),
(16, 'Anemia', 'Low red blood cell count.', '[\"Fatigue\",\"Weakness\",\"Pale skin\",\"Shortness of breath\",\"Dizziness\",\"Cold hands or feet\"]', '[\"Iron supplements\",\"Vitamin B12 shots\",\"Folic acid\",\"Dietary changes\",\"Blood transfusion if severe\"]', '[\"Iron-rich diet\",\"Vitamin C intake\",\"Regular checkups\",\"Treat causes\",\"Avoid blood loss\"]', '2026-02-16 09:20:25'),
(17, 'Dengue', 'Mosquito-borne viral disease.', '[\"High fever\",\"Severe headache\",\"Pain behind eyes\",\"Joint and muscle pain\",\"Nausea\",\"Skin rash\"]', '[\"Rest and hydration\",\"Pain relievers\",\"Hospitalization if severe\",\"Platelet transfusion if needed\"]', '[\"Mosquito control\",\"Use repellents\",\"Protective clothing\",\"Remove standing water\",\"Use nets\"]', '2026-02-16 09:20:25'),
(18, 'Malaria', 'Parasitic mosquito-borne disease.', '[\"Fever and chills\",\"Sweating\",\"Headache\",\"Nausea\",\"Muscle pain\",\"Fatigue\"]', '[\"Antimalarial medicines\",\"Artemisinin therapy\",\"Quinine\",\"Chloroquine\",\"Hospital care if severe\"]', '[\"Preventive medicines\",\"Mosquito nets\",\"Repellent\",\"Cover skin\",\"Remove breeding sites\"]', '2026-02-16 09:20:25'),
(19, 'Pneumonia', 'Lung infection causing inflammation.', '[\"Cough with phlegm\",\"Fever\",\"Chills\",\"Shortness of breath\",\"Chest pain\",\"Fatigue\"]', '[\"Antibiotics\",\"Antiviral drugs\",\"Cough medicine\",\"Fever reducers\",\"Oxygen therapy\"]', '[\"Pneumonia vaccine\",\"Flu vaccine\",\"Good hygiene\",\"Avoid smoking\",\"Healthy lifestyle\"]', '2026-02-16 09:20:25'),
(20, 'Depression', 'Mental health disorder.', '[\"Persistent sadness\",\"Loss of interest\",\"Sleep changes\",\"Appetite changes\",\"Fatigue\",\"Suicidal thoughts\"]', '[\"Psychotherapy\",\"Antidepressants\",\"Lifestyle changes\",\"Support groups\",\"ECT if severe\"]', '[\"Exercise\",\"Social support\",\"Stress management\",\"Healthy sleep\",\"Seek help early\"]', '2026-02-16 09:20:25'),
(21, 'Gastritis', 'Inflammation of stomach lining.', '[\"Upper abdominal pain\",\"Nausea\",\"Vomiting\",\"Bloating\",\"Loss of appetite\",\"Indigestion\"]', '[\"Antacids\",\"H2 blockers\",\"Proton pump inhibitors\",\"Antibiotics\",\"Diet changes\"]', '[\"Avoid irritants\",\"Limit alcohol\",\"Manage stress\",\"Smaller meals\",\"Avoid NSAIDs\"]', '2026-02-16 09:20:25'),
(22, 'Osteoporosis', 'Bone disease increasing fracture risk.', '[\"Back pain\",\"Loss of height\",\"Stooped posture\",\"Easy fractures\",\"Reduced mobility\"]', '[\"Bisphosphonates\",\"Calcium supplements\",\"Vitamin D\",\"Exercise\",\"Bone medicines\"]', '[\"Calcium and vitamin D\",\"Exercise\",\"Avoid smoking\",\"Limit alcohol\",\"Prevent falls\"]', '2026-02-16 09:20:25'),
(23, 'Alzheimers', 'Neurodegenerative disease affecting memory.', '[\"Memory loss\",\"Confusion\",\"Communication difficulty\",\"Poor judgment\",\"Personality change\",\"Getting lost\"]', '[\"Cholinesterase inhibitors\",\"Memantine\",\"Cognitive therapy\",\"Support care\",\"Safety planning\"]', '[\"Mental stimulation\",\"Social activity\",\"Healthy diet\",\"Exercise\",\"Heart health care\"]', '2026-02-16 09:20:25'),
(24, 'Parkinsons', 'Neurological movement disorder.', '[\"Tremors\",\"Stiffness\",\"Slow movement\",\"Balance issues\",\"Speech changes\",\"Writing changes\"]', '[\"Levodopa\",\"Dopamine agonists\",\"MAO B inhibitors\",\"Physical therapy\",\"Brain stimulation\"]', '[\"Exercise\",\"Healthy diet\",\"Avoid toxins\",\"Possible caffeine benefit\",\"No confirmed prevention\"]', '2026-02-16 09:20:25'),
(25, 'Cancer', 'Uncontrolled cell growth forming tumors.', '[\"Lumps\",\"Weight loss\",\"Fatigue\",\"Skin changes\",\"Persistent cough\",\"Unusual bleeding\"]', '[\"Surgery\",\"Chemotherapy\",\"Radiation\",\"Immunotherapy\",\"Targeted therapy\"]', '[\"Avoid smoking\",\"Healthy diet\",\"Exercise\",\"Sun protection\",\"Regular screening\"]', '2026-02-16 09:20:25'),
(26, 'Hepatitis', 'Liver inflammation often viral.', '[\"Fatigue\",\"Jaundice\",\"Abdominal pain\",\"Loss of appetite\",\"Nausea\",\"Dark urine\"]', '[\"Antiviral drugs\",\"Interferon therapy\",\"Transplant if severe\",\"Rest\",\"Avoid alcohol\"]', '[\"Vaccination\",\"Safe practices\",\"Avoid needle sharing\",\"Food safety\",\"Limit alcohol\"]', '2026-02-16 09:20:25'),
(27, 'Thyroid Disorder', 'Hormonal imbalance of thyroid gland.', '[\"Weight changes\",\"Fatigue\",\"Mood changes\",\"Temperature sensitivity\",\"Hair changes\",\"Heart rate changes\"]', '[\"Hormone therapy\",\"Anti-thyroid drugs\",\"Radioactive iodine\",\"Surgery\",\"Monitoring\"]', '[\"Iodine intake\",\"Regular checkups\",\"Stress control\",\"Avoid radiation\",\"Healthy lifestyle\"]', '2026-02-16 09:20:25'),
(28, 'High Cholesterol', 'High lipid levels in blood.', '[\"Often no symptoms\",\"Fatty deposits\",\"Chest pain\",\"Shortness of breath\"]', '[\"Statins\",\"Fibrates\",\"Niacin\",\"Diet control\",\"Exercise\"]', '[\"Healthy diet\",\"Exercise\",\"Healthy weight\",\"Avoid smoking\",\"Limit alcohol\"]', '2026-02-16 09:20:25'),
(29, 'Kidney Stones', 'Hard mineral deposits in kidneys.', '[\"Severe side pain\",\"Painful urination\",\"Blood in urine\",\"Nausea\",\"Frequent urination\",\"Fever if infected\"]', '[\"Pain relief\",\"Fluids\",\"Stone-passing medicines\",\"Lithotripsy\",\"Surgery\"]', '[\"Drink water\",\"Reduce salt\",\"Limit oxalate foods\",\"Adequate calcium\",\"Limit animal protein\"]', '2026-02-16 09:20:25'),
(30, 'Psoriasis', 'Chronic autoimmune skin disease.', '[\"Red scaly patches\",\"Dry skin\",\"Itching\",\"Nail changes\",\"Joint stiffness\"]', '[\"Topical steroids\",\"Vitamin D creams\",\"Light therapy\",\"Oral drugs\",\"Biologics\"]', '[\"Moisturize\",\"Avoid triggers\",\"Manage stress\",\"Avoid smoking\",\"Limit alcohol\"]', '2026-02-16 09:20:25'),
(31, 'Bronchitis', 'Inflammation of bronchial tubes in lungs.', '[\"Cough with mucus\",\"Fatigue\",\"Shortness of breath\",\"Slight fever\",\"Chest discomfort\"]', '[\"Cough medicine\",\"Bronchodilators\",\"Rest and fluids\"]', '[\"No smoking\",\"Avoid irritants\",\"Wash hands\",\"Vaccination\"]', '2026-02-16 09:22:27'),
(32, 'Epilepsy', 'Neurological disorder causing seizures.', '[\"Temporary confusion\",\"Jerking movements\",\"Loss of consciousness\"]', '[\"Anti-seizure medications\",\"Surgery\",\"Neurostimulation\"]', '[\"Take medicines regularly\",\"Adequate sleep\",\"Avoid triggers\"]', '2026-02-16 09:22:27'),
(33, 'Obesity', 'Excessive body fat accumulation.', '[\"Excess body fat\",\"Fatigue\",\"Joint pain\"]', '[\"Diet control\",\"Exercise\",\"Medication\",\"Surgery\"]', '[\"Balanced diet\",\"Regular exercise\",\"Routine checkups\"]', '2026-02-16 09:22:27'),
(34, 'Allergy', 'Immune reaction to substances.', '[\"Sneezing\",\"Itching\",\"Runny nose\",\"Skin rash\"]', '[\"Antihistamines\",\"Avoid allergens\",\"Immunotherapy\"]', '[\"Avoid allergens\",\"Keep surroundings clean\"]', '2026-02-16 09:22:27'),
(35, 'Common Cold', 'Viral infection of nose and throat.', '[\"Runny nose\",\"Cough\",\"Sneezing\",\"Sore throat\"]', '[\"Rest\",\"Fluids\",\"Cold medicines\"]', '[\"Wash hands\",\"Avoid sick contacts\"]', '2026-02-16 09:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medication` varchar(150) NOT NULL,
  `reminder_time` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `symptom` varchar(150) NOT NULL,
  `severity` enum('Mild','Moderate','Severe') DEFAULT 'Mild',
  `symptom_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `user_id`, `symptom`, `severity`, `symptom_date`, `notes`, `created_at`) VALUES
(3, 4, 'headache', 'Moderate', '2026-02-17', 'abc', '2026-02-17 05:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar_initial` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `avatar_initial`) VALUES
(1, 'riya', 'riya1@gmail.com', '1234', '2026-02-16 08:58:40', 'R'),
(3, 'Shreya', 'shreya1@gmail.com', '1234', '2026-02-17 04:11:32', 'S'),
(4, 'Bibha', 'bibha@gmail.com', '12345', '2026-02-17 05:54:09', 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD CONSTRAINT `symptoms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
