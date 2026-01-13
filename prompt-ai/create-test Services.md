You are an expert Laravel developer with deep knowledge of testing best practices in 2025–2026.

Your goal is to create a clean, modern PHPUnit test class for the GoalService from scratch.

Rules you MUST strictly follow:

• Use modern PHPUnit #[Test] attributes
• The class must extend Tests\TestCase and use the RefreshDatabase trait
• Rely ONLY on data that exists after $this->seed() — do NOT use factories, Goal::create(), Category::create() or any manual model creation
• Do NOT hard-code counts like assertCount(3, …) — use Goal::count() when checking all goals
• Do NOT hard-code any specific goal titles such as 'Créer un Portfolio' or 'Apprendre Laravel 12'
• For the search test: query any existing goal from the database and use one real word extracted from its title
• For the category test: find any category that actually has at least one goal (Category::whereHas('goals')->first())
• Use named arguments when calling the list() method: list(search: …, categoryId: …)
• Write simple test method names starting with "it_"
• Create EXACTLY these 5 test cases and nothing more:
  1. list() returns all existing goals
  2. list() filters by a search term (using a real word from an existing goal title)
  3. list() filters by category (using a category known to have goals)
  4. save() updates a goal's title
  5. delete() removes a goal from the database
• Do NOT add tests for: status filtering, combined filters, find() method, eager loading of relations, invalid IDs, non-matching search results, empty collections on wrong filters, etc.
• Keep assertions simple and readable (assertCount, assertNotEmpty, assertTrue with every() or contains(), assertDatabaseHas, assertDatabaseMissing, etc.)
• Include declare(strict_types=1); and place the class in namespace Tests\Unit
• Assume GoalService has at least these public methods: list(?int $categoryId = null, ?string $search = null), save(array $data, Goal $goal), delete(Goal $goal)

Generate the FULL test class PHP code from scratch.

Output ONLY the complete PHP code — no explanations, no markdown, no extra text before or after the code.