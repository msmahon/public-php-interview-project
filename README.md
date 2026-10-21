# PHP Interview Exercise — Employee Org Chart

Takes an employee and an action, and returns the employee's manager, direct reports,
or full reporting tree (with indentation showing level).

## Setup

Using SQLite (no server needed):

```
sqlite3 employees.db < sqlite.sql
```

MySQL is also supported via `mysql.sql` — see `candidate_instructions.md` for the
Docker setup. `DB.php` only needs its PDO DSN string changed to point at MySQL instead
of SQLite; everything else (`EmployeeService.php`, the SQL itself) is unchanged.

## Running

```
php -S localhost:8000
```

## Usage

```
localhost:8000?employee_id=<id>&action=<manager|direct_reports|everyone_below>
```

Examples (matching `candidate_instructions.md`):

- `localhost:8000?employee_id=1010&action=manager` — manager of Ben Walsh
- `localhost:8000?employee_id=1002&action=direct_reports` — direct reports of David Okafor
- `localhost:8000?employee_id=1006&action=everyone_below` — everyone below Tom Becker

## Notes

- Plain PHP, no framework — PDO directly, with prepared statements throughout and
  output escaped via `e()`.
- Added an index on `manager_id` in both SQL files since every lookup filters on it.
- With more time: tests around `EmployeeService`, pagination/lazy-loading for
  `everyone_below` on very deep org charts, more robust routing (currently a single
  `index.php` entry point with no path-based routes), and stricter query param
  validation (e.g. rejecting a non-numeric `employee_id` or an unrecognized `action`
  with a proper 400 response instead of falling through to "no employee found").
