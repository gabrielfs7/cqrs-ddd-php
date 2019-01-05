fromCategory(':fromStream')
.foreachStream()
.when(
    {
        $init: function() {
            return {
                total: 0,
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
                        birthday: event.body.birthday
                    }
                );
            }
        }
    }
)