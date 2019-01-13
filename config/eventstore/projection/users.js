fromCategory(':fromCategory')
.foreachStream()
.when(
    {
        $init: function() {
            return {
                total: 0,
                offset: 0,
                limit: 0,
                data: []
            }
        },
        UserCreated: function(state, event) {
            if (event.body.birthday.length > 0) {
                state.total++;
                state.data.push(
                    {
                        userId: event.body.id,
                        fullName: event.body.fullName,
                        username: event.body.username,
                        birthday: event.body.birthday
                    }
                );
            }
        }
    }
)