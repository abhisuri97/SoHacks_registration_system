<?php

// require INC_ROOT . '/app/routes/welcome.php';

require INC_ROOT . '/app/routes/home.php';
require INC_ROOT . '/app/routes/info.php';
require INC_ROOT . '/app/routes/resources.php';

require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/activate.php';
require INC_ROOT . '/app/routes/auth/logout.php';
require INC_ROOT . '/app/routes/auth/password/change.php';
require INC_ROOT . '/app/routes/auth/password/recover.php';
require INC_ROOT . '/app/routes/auth/password/reset.php';
require INC_ROOT . '/app/routes/auth/invite.php';
require INC_ROOT . '/app/routes/auth/decision.php';
require INC_ROOT . '/app/routes/auth/team.php';
require INC_ROOT . '/app/routes/auth/sign.php';


require INC_ROOT . '/app/routes/account/profile.php';

require INC_ROOT . '/app/routes/user/profile.php';
require INC_ROOT . '/app/routes/user/all.php';

require INC_ROOT . '/app/routes/admin/attendees/admitAttendees.php';
require INC_ROOT . '/app/routes/admin/mentors/admitMentors.php';
require INC_ROOT . '/app/routes/admin/volunteers/admitVolunteers.php';
require INC_ROOT . '/app/routes/admin/shifts.php';
require INC_ROOT . '/app/routes/admin/notice.php';
require INC_ROOT . '/app/routes/admin/workshops.php';
require INC_ROOT . '/app/routes/admin/signin.php';
require INC_ROOT . '/app/routes/admin/signinprof.php';
require INC_ROOT . '/app/routes/admin/new.php';
require INC_ROOT . '/app/routes/admin/text.php';


require INC_ROOT . '/app/routes/errors/404.php';
