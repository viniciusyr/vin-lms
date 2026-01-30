# LMS Core Plugin

**Minimal Learning Management System (LMS) for WordPress**  
Designed as a domain-driven, scalable, and testable plugin architecture.

---

## Table of Contents

1. [Overview](#overview)  
2. [Features (MVP)](#features-mvp)  
3. [Architecture](#architecture)  
4. [Folder Structure](#folder-structure)  
5. [Domain Model](#domain-model)  
6. [Installation](#installation)  
7. [Usage](#usage)  
8. [Testing](#testing)  
9. [Future Evolution](#future-evolution)  
10. [Best Practices](#best-practices)  

---

## Overview

LMS Core is a minimal yet extendable Learning Management System for WordPress.  
It allows you to:

- Create and manage courses and lessons
- Enroll users in courses
- Track progress per lesson and per course
- Provide a simple student dashboard
- Support multiple instructors (future-ready)

**Key Principles:**

- **Domain-driven design**: Core business logic is isolated from WordPress dependencies  
- **Testable**: Services and domain can be unit-tested independently  
- **Evolvable**: Ready for future features (payment, quizzes, certificates)  
- **WP-friendly**: Uses CPTs, hooks, and WP authentication  

---

## Features (MVP)

### Mandatory (MVP)

- **Course Management**
  - Create, edit, publish courses
- **Lesson Management**
  - Create lessons with text or video content
  - Order lessons within a course
- **User Enrollment**
  - Enroll users in courses
- **Progress Tracking**
  - Mark lessons as completed
  - Calculate course progress
- **Student Dashboard**
  - View enrolled courses
  - Track progress
- **Admin Dashboard**
  - View students and course completion statistics
- **Authentication & Authorization**
  - Leverage WordPress user system and roles (`lms_student`, `lms_instructor`)

### Explicitly deferred (Nice-to-Have)

- Payments & subscriptions  
- Quizzes & assessments  
- Certificates  
- Course prerequisites  
- Forum / comments / gamification  
- Advanced reporting  
- Multi-format uploads  
- Mobile app / notifications  

---

## Architecture

**Principles:**

1. **Domain Isolation**  
   - All core entities (Course, Lesson, Enrollment, Progress) are independent of WordPress  
2. **Application Layer**  
   - Handles business rules and use cases (e.g., enroll user, complete lesson)  
3. **Infrastructure Layer**  
   - Deals with WordPress-specific implementation:
     - CPT registration
     - Admin pages
     - Hooks (actions & filters)
     - Repositories
4. **Interfaces Layer**  
   - Abstraction for services and repositories, enabling future changes in storage or APIs
5. **Public API**  
   - Exposes plugin functions for theme and external integration

---

## Folder Structure

wp-content/
└── plugins/
    └── vin-lms-core/
    │   ├── vin-lms.php
    │   ├── composer.json
    │   ├── readme.txt
    │   │
    │   ├── bootstrap/
    │   │   └── app.php
    │   │
    │   ├── config/
    │   │   ├── capabilities.php
    │   │   ├── roles.php
    │   │   └── constants.php
    │   │
    │   ├── src/
    │   │   ├── Domain/
    │   │   │   ├── Course/
    │   │   │   │   ├── Course.php
    │   │   │   │   ├── CourseStatus.php
    │   │   │   │   └── CourseCollection.php
    │   │   │   │
    │   │   │   ├── Lesson/
    │   │   │   │   ├── Lesson.php
    │   │   │   │   └── LessonType.php
    │   │   │   │
    │   │   │   ├── Enrollment/
    │   │   │   │   ├── Enrollment.php
    │   │   │   │   └── EnrollmentStatus.php
    │   │   │   │
    │   │   │   └── Progress/
    │   │   │       ├── Progress.php
    │   │   │       └── CompletionEvent.php
    │   │   │
    │   │   ├── Application/
    │   │   │   ├── Services/
    │   │   │   │   ├── EnrollmentService.php
    │   │   │   │   ├── ProgressService.php
    │   │   │   │   └── CourseCompletionService.php
    │   │   │   │
    │   │   │   └── UseCases/
    │   │   │       ├── EnrollUserInCourse.php
    │   │   │       ├── CompleteLesson.php
    │   │   │       └── GetUserCourseProgress.php
    │   │   │
    │   │   ├── Infrastructure/
    │   │   │   ├── WordPress/
    │   │   │   │   ├── Hooks/
    │   │   │   │   │   ├── Actions.php
    │   │   │   │   │   └── Filters.php
    │   │   │   │   │
    │   │   │   │   ├── PostTypes/
    │   │   │   │   │   ├── CoursePostType.php
    │   │   │   │   │   └── LessonPostType.php
    │   │   │   │   │
    │   │   │   │   ├── Repositories/
    │   │   │   │   │   ├── CourseRepository.php
    │   │   │   │   │   │
    │   │   │   │   │   ├── LessonRepository.php
    │   │   │   │   │   │
    │   │   │   │   │   └── ProgressRepository.php
    │   │   │   │   │
    │   │   │   │   ├── Auth/
    │   │   │   │   │   └── AccessControl.php
    │   │   │   │   │
    │   │   │   │   └── Admin/
    │   │   │   │       ├── CourseAdmin.php
    │   │   │   │       └── LessonAdmin.php
    │   │   │   │
    │   │   │   └── Database/
    │   │   │       ├── Migrations/
    │   │   │       │   └── CreateProgressTable.php
    │   │   │       └── Schema.php
    │   │   │
    │   │   ├── Interfaces/
    │   │   │   ├── Repositories/
    │   │   │   │   ├── CourseRepositoryInterface.php
    │   │   │   │   ├── LessonRepositoryInterface.php
    │   │   │   │   └── ProgressRepositoryInterface.php
    │   │   │   │
    │   │   │   └── Services/
    │   │   │       ├── EnrollmentServiceInterface.php
    │   │   │       └── ProgressServiceInterface.php
    │   │   │
    │   │   └── Support/
    │   │       ├── Helpers/
    │   │       ├── Collections/
    │   │       └── ValueObjects/
    │   │
    │   ├── tests/
    │   │   ├── Unit/
    │   │   │   ├── Domain/
    │   │   │   └── Application/
    │   │   │
    │   │   └── Integration/
    │   │       └── WordPress/
    │   │
    │   └── public/
    │       ├── api.php
    │       └── functions.php
    └── themes/
        └── vin-lms-theme/

## Domain Model

**Entities:**

- `Course` – A unit of learning, contains lessons  
- `Lesson` – A consumable piece of content (text/video)  
- `User` – Student or instructor (leveraging WordPress users)  
- `Enrollment` – Links user to course (access control)  
- `Progress` – Records completed lessons by user  

**Key Relationships:**

- `Course 1:N Lesson`  
- `User N:M Course` via Enrollment  
- `User N:M Lesson` via Progress  

**Important Business Rules:**

- User can only access lessons if enrolled  
- Lessons are marked complete once per user  
- Course completion is calculated as `completed lessons / total lessons`  
- Domain logic is isolated from theme and WordPress UI  

**Future Domain Changes:**

- Lessons can include quizzes, assignments, or live sessions  
- Course completion may require assessments or approvals  
- Multi-instructor courses  
- Payment-dependent enrollment  
- Certificates generation  

---

## Installation

1. Copy `lms-core` folder into `wp-content/plugins/`  
2. Activate the plugin from WordPress Admin  
3. Configure roles and capabilities from `config/roles.php`  
4. Run database migrations (via `Infrastructure/Database/Migrations`)  

---

## Usage

**Public API Examples:**

```php
// Enroll user in a course
lms_enroll_user($userId, $courseId);

// Complete a lesson
lms_complete_lesson($userId, $lessonId);

// Get user courses and progress
$courses = lms_get_user_courses($userId);
$progress = lms_get_user_course_progress($userId, $courseId);

// Check access to a lesson
if (lms_can_access_lesson($userId, $lessonId)) {
    // render lesson
}
```

## Theme Integration:

- Use public/api.php functions

- Theme does not query WP posts directly

## Testing

- Unit Tests: Domain & Application layer (no WordPress dependency)
- Integration Tests: Infrastructure layer with WP hooks and DB
- PHPUnit recommended with mocks for repositories

## Future Evolution

**Planned extensions:**

- Payment & subscription modules
- Quizzes & assessments
- Certificates & reporting
- API for mobile apps / SPA frontends
- Multi-site and multi-instructor support

**Guidelines for evolution:**
- Keep domain isolated
- Add modules without modifying core domain
- Use interfaces to decouple future storage changes
- Public API functions are contract for theme and apps

## Best Practices
- Domain logic never in theme
- Progress and enrollment stored in separate tables
- Use WP CPTs for content, WP users for authentication
- Hooks and WP-specific code only in Infrastructure/WordPress
- Public functions are single source of truth for other layers
- Follow PSR-12 coding standards and WordPress coding guidelines